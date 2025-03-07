<?php

namespace App\Livewire;

use App\Enums\AvailableOptions;
use App\Enums\CatalogBannerTypeEnum;
use App\Models\Brand;
use App\Models\CatalogBanner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;


class CatalogBak extends Component
{
    use WithPagination;

    const PER_PAGE = 24;
    public int $perPage = 24;

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    public string $modelClass;
    public ?Category $category = null;
    public ?Brand $brand = null;

    public Collection $allProducts;
    public Collection $currentProducts;

    #[Url]
    public string $filterSearch = '';
    #[Url]
    public string $filterCategoryId = '';
    #[Url(as: 'brands')]
    public array $filterBrands = [];
    #[Url]
    public array $filterProperties = [];
    #[Url]
    public int $filterMinPrice = 0;
    #[Url]
    public int $filterMaxPrice = 999999;
    public string $sort = 'default:desc';


    public function mount(string $modelClass, ?Category $category = null, ?Brand $brand = null)
    {
        $this->modelClass = $modelClass;
        $this->category = $category;
        $this->brand = $brand;

        $this->allProducts = $this->getAllProducts(['brand', 'imagePrint', 'publishedComments', 'product_variations']);
        $this->currentProducts = $this->getFiltered();
    }

    #[On('filterCatalog')]
    public function filterCatalog()
    {
        $this->currentProducts = $this->getFiltered();
        dump($this->filterBrands);
        $this->render();
    }

    public function render()
    {
        $page = Paginator::resolveCurrentPage();
        $products = new LengthAwarePaginator(
            $this->currentProducts->forPage($page, $this->perPage),
            $this->currentProducts->count(),
            $this->perPage,
            $page
        );
        $gridItems = $this->getGridItems($products->collect());

        return view('livewire.catalog', compact('products', 'gridItems'));
    }

    public function getAllProducts(?array $with = null): \Illuminate\Database\Eloquent\Collection
    {
        $query = Product::query()
            ->select(['products.id', 'products.title', 'products.alias', 'products.status', 'products.old_price',
                'products.price', 'products.image_print_id', 'products.category_id', 'products.base_property_id',
                'products.brand_id', 'products.availability', 'products.code', 'products.rrp', 'products.discount',
                'products.items_left'])
            ->selectRaw('case when user_favorite_products.product_id is null then FALSE else TRUE end as is_favourite')
            ->whereNot('availability', AvailableOptions::DISCONTINUED->value)
            ->when($with, function ($query) use ($with) {
                $query->with($with);
            })
            ->when($this->modelClass == Category::class, function (Builder $query) {
                $allCategoriesIds = Category::getChildIds($this->category->id);
                $query->where(function ($q) use ($allCategoriesIds) {
                    $q->whereIn('products.id', function ($query) use ($allCategoriesIds) {
                        $query->select('product_id')
                            ->from('product_categories')
                            ->whereIn('category_id', $allCategoriesIds);
                    })
                        ->orWhereIn('category_id', $allCategoriesIds);
                });
            })
            ->when($this->modelClass == Brand::class, function (Builder $query) {
                $query->where('brand_id', $this->brand->id);
            });

        if (Auth::check()) {
            $favourites = DB::table('user_favorite_products')->select('user_favorite_products.*')->where('user_id', Auth::id());
            $query = $query->leftJoinSub($favourites, 'user_favorite_products', function (JoinClause $join) {
                $join->on('user_favorite_products.product_id', '=', 'products.id');
            });
        } else {
            $query = $query->leftJoin('user_favorite_products', 'user_favorite_products.product_id', '=', 'products.id');
        }

        return $query->get();
    }

    public function getFiltered(): Collection
    {
        $products = $this->allProducts;

        // Фільтр по заголовку та артиклу
        if (!empty($this->filterSearch)) {
            $products = $products->filter(function ($product) {
                $words = explode(' ', $this->filterSearch);

                // Перевіряємо, чи ВСІ слова з пошуку є в title
                $titleMatch = collect($words)->every(fn($word) => stripos($product->title, $word) !== false);

                // Перевіряємо артикул
                $codeMatch = stripos($product->code, $this->filterSearch) !== false;

                return $titleMatch || $codeMatch;
            })->values();
        }

        // Фільтрація за властивостями
        if (!empty($this->filterProperties)) {
            $products = $products->filter(function ($product) {
                return $product->values->pluck('id')->intersect(collect($this->filterProperties)->flatten())->isNotEmpty();
            })->values();
        }

        // Фільтрація за брендами
        if (!empty($this->filterBrands)) {
            $products = $products->filter(fn($product) => in_array($product->brand_id, $this->filterBrands))->values();
        }

        // Фільтрація за категорією
        if (!empty($this->filterCategoryId)) {
            $products = $products->filter(function ($product)  {
                $belongsToCategory = $product->categories()->pluck('id')->contains($this->filterCategoryId);
                return $belongsToCategory || $product->category_id == $this->filterCategoryId;
            })->values();
        }

        $this->dispatch(
            'set-products-prices',
            min: $products->min('price'),
            max: $products->max('price')
        )->to(Filter::class);

        // Фільтрація за ціною
        $priceFrom = $this->getPriceFrom();
        $priceTo = $this->getPriceTo();
        $products = $products->filter(function ($product) use ($priceFrom, $priceTo) {
            return $product->price >= $priceFrom && $product->price <= $priceTo;
        })->values();

        $sortColumn = $this->getSortColumn();
        $sortDirection = $this->getSortDirection();
        if ($sortColumn == 'default') {
            $relation = $this->modelClass == Brand::class ? $this->brand : $this->category;
            $productSortIds = $relation?->productSorts()->pluck('product_id')->toArray() ?? [];

            $products = $products->sort(function ($a, $b) use ($productSortIds) {
                // Пріоритетне сортування за кастомним порядком
                $posA = array_search($a->id, $productSortIds);
                $posB = array_search($b->id, $productSortIds);

                if ($posA === false) $posA = PHP_INT_MAX;
                if ($posB === false) $posB = PHP_INT_MAX;

                if ($posA !== $posB) {
                    return $posA <=> $posB;
                }

                // Додаткове сортування за created_at (DESC)
                if ($a->created_at != $b->created_at) {
                    return $b->created_at <=> $a->created_at;
                }

                // Додаткове сортування за id (DESC)
                return $b->id <=> $a->id;
            })->values();
        } else {
            // Сортування за конкретним стовпцем
            $products = $products->sort(function ($a, $b) use ($sortColumn, $sortDirection) {
                if ($a->$sortColumn == $b->$sortColumn) {
                    return 0;
                }
                return ($sortDirection === 'asc')
                    ? ($a->$sortColumn <=> $b->$sortColumn)
                    : ($b->$sortColumn <=> $a->$sortColumn);
            })->values();
        }

        return $products;
    }

    public function getPriceFrom()
    {
        return $this->filterMinPrice ?? $this->productsMinPrice;
    }

    public function getPriceTo()
    {
        return $this->filterMaxPrice ?? $this->productsMaxPrice;
    }

    private function getSortColumn()
    {
        return explode(':', $this->sort)[0];
    }

    private function getSortDirection()
    {
        return explode(':', $this->sort)[1];
    }



    public static function getProductVariations($product_id, $base_property_id)
    {
        return Product::query()
            ->select(['products.*', 'property_value.value as base_property_value', 'properties.name as base_property_name', 'properties.measure as base_property_measure'])
            ->join('product_variations', function ($join) use ($product_id) {
                $join->on('product_variations.variation_id', '=', 'products.id')
                    ->where('product_variations.product_id', $product_id);
            })
            ->leftJoin('product_property_values', function ($join) use ($base_property_id) {
                $join->on('product_property_values.product_id', '=', 'products.id')
                    ->where('product_property_values.property_id', $base_property_id);
            })
            ->leftJoin('property_value', 'product_property_values.property_value_id', '=', 'property_value.id')
            ->leftJoin('properties', 'properties.id', '=', DB::raw($base_property_id))
            ->get();
    }


    public static function getProduct($id)
    {
        return Product::find($id);
    }

    public function getCatalogBannerConditions()
    {
        $bannerConditions = match ($this->modelClass) {
            Category::class => call_user_func(function () {
                $category = $this->category;
                $bannerConditions = $category->activeBannerConditions()
                    ->with('randomBanner')
                    ->get();

                while ($category->parent) {
                    $category = $category->parent;
                    $parentBannerConditions = $category->activeBannerConditions()
                        ->where('share_with_child', true)
                        ->whereNotIn('row', $bannerConditions->pluck('row'))
                        ->with('randomBanner')
                        ->get();
                    $bannerConditions = $bannerConditions->merge($parentBannerConditions);
                };

                return $bannerConditions;
            }),
            Brand::class => $this->brand->activeBannerConditions()->with('randomBanner')->get(),
        };

        $banners = [];
        foreach ($bannerConditions as $bannerCondition)
            $banners[$bannerCondition->row] = $bannerCondition->randomBanner;

        return $banners;
    }

    public function getGridItems(\Illuminate\Support\Collection $products, int $cardsPerRow = 3): array
    {
        $banners = $this->getCatalogBannerConditions();
        $grid = [];

        for ($row = 1; $products->isNotEmpty(); $row++) {
            if (isset($banners[$row])) {
                $banner = $banners[$row];
                if ($banner->type === CatalogBannerTypeEnum::CATALOG_CARD->value) {
                    $bannerIndex = match ($banner->data['align']) {
                        CatalogBanner::ALIGN_LEFT => 0,
                        CatalogBanner::ALIGN_CENTER => 1,
                        CatalogBanner::ALIGN_RIGHT => $cardsPerRow >= 3 ? 2 : 1,
                    };

                    for ($card = 0; $card < $cardsPerRow; $card++) {
                        if ($card === $bannerIndex)
                            $grid[$row][] = $banner;
                        else
                            $grid[$row][] = $products->shift();
                    }
                } else { // full width
                    $grid[$row] = [$banner];
                }
            } else {
                for ($card = 0; $card < $cardsPerRow; $card++)
                    $grid[$row][] = $products->shift();
            }
        }

        return $grid;
    }


    public function updatingPage($page)
    {
        $this->perPage = self::PER_PAGE;
    }

    public function loadMore()
    {
        $this->perPage += self::PER_PAGE;
        $this->dispatch('$refresh');
    }
}
