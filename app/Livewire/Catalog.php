<?php

namespace App\Livewire;

use App\Enums\AvailableOptions;
use App\Enums\CatalogBannerTypeEnum;
use App\Models\Brand;
use App\Models\CatalogBanner;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPropertyValue;
use App\Models\Property;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;


class Catalog extends Component
{
    use WithPagination;

    const PER_PAGE = 24;
    public int $perPage = 24;

    public string $modelClass;
    public ?Category $category = null;
    public ?Brand $brand = null;

    public Collection $allProducts;

    public int $currentProductsMinPrice;
    public int $currentProductsMaxPrice;

    #[Url(as: 'search')]
    public string $filterSearch = '';
    #[Url(as: 'category')]
    public string $filterCategoryId = '';
    #[Url(as: 'brands')]
    public array $filterBrands = [];
    #[Url(as: 'properties')]
    public array $filterProperties = [];
    #[Url(as: 'min-price')]
    public ?int $filterMinPrice = null;
    #[Url(as: 'max-price')]
    public ?int $filterMaxPrice = null;
    #[Url]
    public string $sort = 'default:desc';


    public function mount(string $modelClass, ?Category $category = null, ?Brand $brand = null)
    {
        $this->modelClass = $modelClass;
        $this->category = $category;
        $this->brand = $brand;

        $this->allProducts = $this->getAllProducts(['brand', 'imagePrint', 'publishedComments', 'baseProperty']);
    }

    public function render()
    {
        $currentProducts = $this->getFiltered();
        $page = Paginator::resolveCurrentPage();
        $products = new LengthAwarePaginator(
            $currentProducts->forPage($page, $this->perPage),
            $currentProducts->count(),
            $this->perPage,
            $page
        );
        $gridItems = $this->getGridItems($products->collect());

        $isNotBrands = $this->modelClass !== Brand::class;
        $properties = $this->getFilters($currentProducts->pluck('id')->toArray());
        $brands = $this->getBrands();

        return view('livewire.catalog', compact('products', 'gridItems', 'isNotBrands', 'properties', 'brands'));
    }

    public function rendered()
    {
        $this->dispatch('catalog-rendered');
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
            ->withCount('product_variations')
            ->when($with, function ($query) use ($with) {
                $query->with($with);
            })
            ->when($this->filterSearch, function ($query) {
                $query->titleSearch($this->filterSearch);
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

        // Фільтрація за властивостями
        $products = $products->filter(function ($product) {
            foreach ($this->filterProperties as $propertyId => $propertyValues) {
                $propertyValueIds = array_keys($propertyValues);
                // Отримуємо всі значення властивості для даного товару
                $productPropertyValues = $product->values->where('property_id', $propertyId)->pluck('id');

                // Перевіряємо, чи хоча б одне значення з потрібних є в товарі
                if (!$productPropertyValues->intersect($propertyValueIds)->isNotEmpty()) {
                    return false;
                }
            }
            return true;
        })->values();

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

        $this->currentProductsMinPrice = $products->min('price');
        $this->currentProductsMaxPrice = $products->max('price');
        if (!$this->filterMinPrice || $this->filterMinPrice < $this->currentProductsMinPrice)
            $this->filterMinPrice = $this->currentProductsMinPrice;
        if (!$this->filterMaxPrice || $this->filterMaxPrice > $this->currentProductsMaxPrice)
            $this->filterMaxPrice = $this->currentProductsMaxPrice;

        // Фільтрація за ціною
        if ($this->filterMinPrice && $this->filterMinPrice !== $this->currentProductsMinPrice) {
            $products = $products->filter(function ($product) {
                return $product->price >= $this->filterMinPrice;
            })->values();
        }
        if ($this->filterMaxPrice && $this->filterMaxPrice !== $this->currentProductsMaxPrice) {
            $products = $products->filter(function ($product) {
                return $product->price <= $this->filterMaxPrice;
            })->values();
        }

        [$sortColumn, $sortDirection] = explode(':', $this->sort);
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
            default => [],
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

    public function updatedFilterBrands($value, $key)
    {
        $this->filterMinPrice = null;
        $this->filterMaxPrice = null;

        $this->setPage(1);
    }

    public function updatedFilterProperties($value, $key)
    {
        if ($value === false) {
            $filterProperties = $this->filterProperties;
            Arr::forget($filterProperties, $key);
            $this->filterProperties = array_filter($filterProperties);
        }

        $this->filterMinPrice = null;
        $this->filterMaxPrice = null;

        $this->setPage(1);
    }

    public function resetFilters()
    {
        $this->reset('filterSearch', 'filterCategoryId', 'filterBrands', 'filterProperties', 'filterMinPrice', 'filterMaxPrice');
        $this->setPage(1);
    }


    // FILTERS
    public function getFilters(array $productIds)
    {
        if ($this->modelClass == Category::class || $this->modelClass == Brand::class)
            $properties = $this->getStaticFilters();
        else
            $properties = $this->getDynamicFilters();

        $productPropertyValues = DB::table((new ProductPropertyValue)->getTable())
            ->whereIn('product_id', $productIds)
            ->get()
            ->groupBy('property_id')
            ->map(fn($items) => $items->pluck('property_value_id')->toArray())
            ->toArray();

        $allProductPropertyValues = [];
        if (count($this->filterProperties) == 1) {
            $allProductPropertyValues = DB::table((new ProductPropertyValue)->getTable())
                ->whereIn('product_id', $this->allProducts->pluck('id')->toArray())
                ->get()
                ->groupBy('property_id')
                ->map(fn($items) => $items->pluck('property_value_id')->toArray())
                ->toArray();
        }

        $properties = $properties->filter(function ($property) use($productPropertyValues, $allProductPropertyValues) {
            if (count($this->filterProperties) == 1 && isset($this->filterProperties[$property->id])) {
                $property->values = $property->values
                    ->filter(function ($propertyValue) use ($property, $allProductPropertyValues) {
                        return isset($allProductPropertyValues[$property->id]) && in_array($propertyValue->id, $allProductPropertyValues[$property->id]);
                    });
            } else {
                $property->values = $property->values
                    ->filter(function ($propertyValue) use ($property, $productPropertyValues) {
                        return isset($productPropertyValues[$property->id]) && in_array($propertyValue->id, $productPropertyValues[$property->id]);
                    });;
            }

            return $property->values->isNotEmpty();
        });

        $properties->each(function($property) {
            $property->values = $property->values->sortBy(function($value) {
                if (preg_match('/(\d+)\s.*/', $value->value, $matches)) {
                    return (int) $matches[1];
                }
                return $value->value;
            });
        });

        return $properties;
    }

    private function getStaticFilters(): Collection
    {
        return $this->category
            ->filter_properties()
            ->with('values')
            ->orderBy('name')
            ->get();
    }

    private function getDynamicFilters(): Collection
    {
        return Property::whereHas('values')
            ->with('values')
            ->orderBy('name')
            ->get();
    }

    private function getBrands(array $brandIds = [])
    {
        return Brand::select(['id', 'name'])
            ->whereIn('id', array_unique($this->allProducts->pluck('brand_id')->toArray()))
            ->orderBy('name')
            ->get();
    }

}
