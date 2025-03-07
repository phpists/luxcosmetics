<?php

namespace App\Services;

use App\Enums\AvailableOptions;
use App\Enums\CatalogBannerTypeEnum;
use App\Models\Brand;
use App\Models\CatalogBanner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Property;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Catalog2Service
{
    const PER_PAGE = 24;

    public $request;

    public $category;

    public $brand;

    public $modelName;

    public $products;

    public $min_price = 1;
    public $max_price = 999999;
    public $min_filtered_price = 1;
    public $max_filtered_price = 999999;

    private array $filters_weight = [];

    public function __construct(Request $request, string $modelName, string $custom_alias = null)
    {
        $this->request = $request;
        $this->modelName = $modelName;

        if ($modelName == Category::class) {
            $alias = $custom_alias ?: $request->alias;
            $category = Category::where('alias', $alias)
                ->with(['tags', 'posts'])
                ->firstOrFail();
        } elseif ($modelName == Brand::class) {
            $category = Category::with(['tags', 'posts'])
                ->firstOrFail();

            $this->brand = Brand::where('link', $request->link)->firstOrFail();
        } else {
            abort(404);
        }

        $this->category = $category;
        $this->products = $this->getAllProducts(['brand', 'imagePrint', 'publishedComments', 'product_variations']);
        $prices = $this->products->pluck('price')->toArray();
        if (empty($prices))
            $prices = [1, 999999];
        $this->min_price = min($prices);
        $this->max_price = max($prices);
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
            ->when($this->modelName == Category::class, function (Builder $query) {
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
            ->when($this->modelName == Brand::class, function (Builder $query) {
                $query->where('brand_id', $this->brand->id);
            });

        if (Auth::check()) {
            $favourites = DB::table('user_favorite_products')->select('user_favorite_products.*')->where('user_id', $this->request->user()->id);
            $query = $query->leftJoinSub($favourites, 'user_favorite_products', function (JoinClause $join) {
                $join->on('user_favorite_products.product_id', '=', 'products.id');
            });
        } else {
            $query = $query->leftJoin('user_favorite_products', 'user_favorite_products.product_id', '=', 'products.id');
        }

        return $query->get();
    }

    public function getFiltered()
    {
        $products = $this->products;

        // Фільтр по заголовку та коду
        if ($search = $this->request->get('search')) {
            $products = $products->filter(function ($product) use ($search) {
                $words = explode(' ', $search);

                // Перевіряємо, чи ВСІ слова з пошуку є в title
                $titleMatch = collect($words)->every(fn($word) => stripos($product->title, $word) !== false);

                // Перевіряємо, чи пошук є в code
                $codeMatch = stripos($product->code, $search) !== false;

                return $titleMatch || $codeMatch;
            })->values();
        }

        // Фільтрація за властивостями (properties)
        if ($properties = $this->getProperties()) {
            $products = $products->filter(function ($product) use ($properties) {
                return $product->values->pluck('property_value_id')->intersect(collect($properties)->flatten())->isNotEmpty();
            })->values();
        }

        // Фільтрація за брендами
        if ($brands = $this->request->get('brands')) {
            $products = $products->filter(fn($product) => in_array($product->brand_id, $brands))->values();
        }

        // Фільтрація за категорією
        if ($category_id = $this->request->get('category_id')) {
            $products = $products->filter(function ($product) use ($category_id) {
                $belongsToCategory = $product->categories()->pluck('id')->contains($category_id);
                return $belongsToCategory || $product->category_id == $category_id;
            })->values();
        }

        $sortColumn = $this->getSortColumn();
        $sortDirection = $this->getSortDirection();
        if ($sortColumn == 'default') {
            $relation = $this->modelName == Brand::class ? $this->brand : $this->category;
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

        $this->min_filtered_price = $products->min('price');
        $this->max_filtered_price = $products->max('price');

        // Фільтрація за ціною
        $priceFrom = $this->getPriceFrom();
        $priceTo = $this->getPriceTo();
        $products = $products->filter(function ($product) use ($priceFrom, $priceTo) {
            return $product->price >= $priceFrom && $product->price <= $priceTo;
        })->values();

        $page = Paginator::resolveCurrentPage();
        Log::error($page);
        return new LengthAwarePaginator(
            $products->forPage($page, self::PER_PAGE),
            $products->count(),
            self::PER_PAGE,
            $page
        );
    }

    private function getProperties()
    {
        if (is_array($this->request->get('properties'))
            && count($this->request->get('properties')) > 0) {

            return array_map(function ($item) {
                return array_unique($item);
            }, $this->request->get('properties'));
        }

        return false;
    }

    public function getPriceFrom()
    {
        return $this->request->get('price')['from'] ?? $this->min_price;
    }

    public function getPriceTo()
    {
        return $this->request->get('price')['to'] ?? $this->max_price;
    }

    private function getSortColumn()
    {
        $sort = $this->request->get('sort');
        return $sort ? explode(':', $sort)[0] : 'default';
    }

    private function getSortDirection()
    {
        $sort = $this->request->get('sort');
        return $sort ? explode(':', $sort)[1] : 'desc';
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


    public function getFilters()
    {
        $filters = null;

        if ($this->modelName == Category::class || $this->modelName == Brand::class) {
            $filters = $this->getStaticFilters();
        } elseif ($this->modelName == Product::class) {
            $filters = $this->getDynamicFilters();
        }
        $filters_weight = $this->filters_weight = $this->getFiltersWeight($filters, $this->products);
        $filters = $filters->filter(function ($filter) use($filters_weight) {
            return $filter->values->filter(function ($filter_value) use ($filter, $filters_weight) {
                return $filters_weight[$filter->id][$filter_value->id] > 0;
            })->isNotEmpty();
        });

        $filters->each(function($property) use($filters_weight) {
            $property->values = $property->values->filter(function ($filter_value) use ($property, $filters_weight) {
                return $filters_weight[$property->id][$filter_value->id] > 0;
            });

            $property->values = $property->values->sortBy(function($value) {
                if (preg_match('/(\d+)\s.*/', $value->value, $matches)) {
                    return (int) $matches[1];
                }
                return $value->value;
            });
        });

        return $filters;
    }

    public function getStaticFilters()
    {
        return $this->category
            ->filter_properties()
            ->with('values')
            ->get();
    }

    public function getDynamicFilters()
    {
        return Property::whereHas('values')
            ->with('values')
            ->orderBy('name')
            ->get();
    }

    public function getFiltersWeight($properties, $products = null): array
    {
        if ($this->filters_weight)
            return $this->filters_weight;
        else {
            if (!$products)
                $products = $this->products;

            $productValuesArray = $products->load('values:id')->pluck('values', 'id')->toArray();
            $result = [];

            foreach ($properties as $property) {
                $result[$property->id] = [];
                foreach ($property->values as $propertyValue) {
                    $propertyValueId = $propertyValue->id;
                    $count = 0;
                    foreach ($productValuesArray as $productId => $productValues) {
                        $exists = false;
                        foreach ($productValues as $value) {
                            if ($value['id'] == $propertyValueId)
                                $exists = true;
                        }
                        if ($exists)
                            $count++;
                    }
                    $result[$property->id][$propertyValue->id] = $count;
                }
            }

            $result['brands'] = [];
            foreach (Brand::all() as $brand) {
                $result['brands'][$brand->id] = $products->where('brand_id', $brand->id)->count();
            }

            return $result;
        }
    }

    function getFilterPrices()
    {
        $currentMin = $this->isAppliedAnyFilters()
            ? $this->getPriceFrom() < $this->min_filtered_price ? $this->min_filtered_price : $this->getPriceFrom()
            : $this->min_filtered_price;
        $currentMax = $this->isAppliedAnyFilters()
            ? $this->getPriceTo() > $this->max_filtered_price ? $this->max_filtered_price : $this->getPriceTo()
            : $this->max_filtered_price;

        return [
            'min' => $this->min_price,
            'max' => $this->max_price,
            'filteredMin' => $this->min_filtered_price,
            'filteredMax' => $this->max_filtered_price,
            'currentMin' => (int) $currentMin,
            'currentMax' => (int) $currentMax,
        ];
    }

    private function isAppliedAnyFilters(): bool
    {
        return request('search') || request('brands') || request('category_id') || request('properties');
    }


    public function getBrands()
    {
        return Brand::select(['id', 'name'])
            ->whereIn('id', array_unique($this->products->pluck('brand_id')->toArray()))
            ->orderBy('name')
            ->get();
    }


    public function getCatalogBannerConditions()
    {
        $bannerConditions = match ($this->modelName) {
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

    public function getGridItems(Collection $products, int $cardsPerRow = 3): array
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

}
