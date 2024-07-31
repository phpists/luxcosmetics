<?php

namespace App\Services;

use App\Enums\AvailableOptions;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Property;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CatalogService
{

    const PER_PAGE = 24;
    const PRICE_FROM = 0;
    const PRICE_TO = 750000;

    public $request;

    public $category;
    public $all_category_ids;

    public $brand;

    public $modelName;

    public $products_query;
    public $products;

    public $min_price = 1;
    public $max_price = 999999;
    public $min_filtered_price = 1;
    public $max_filtered_price = 999999;

    public function __construct(Request $request, string $modelName, string $custom_alias = null)
    {
        $this->request = $request;
        $this->modelName = $modelName;

        if ($modelName == Category::class) {
            $alias = $custom_alias ?: $request->alias;
            $category = Category::where('alias', $alias)
                ->with(['tags', 'posts'])
                ->firstOrFail();

            $this->category = $category;
            $this->all_category_ids = Category::getChildIds($category->id);
        } elseif ($modelName == Brand::class) {
            $category = Category::with(['tags', 'posts'])
                ->firstOrFail();

            $this->category = $category;
            $this->brand = Brand::where('link', $request->link)->firstOrFail();
        }


        $this->products = $this->getProductsQuery(['values'])->get();
    }

    public function getProductsQuery(?array $with = null): \Illuminate\Database\Eloquent\Builder
    {
        $query = $this->products_query = Product::query()
            ->select(['products.*', 'product_images.path as main_image'])
            ->leftJoin('product_images', 'products.image_print_id', 'product_images.id')
            ->when($with, function ($query) use ($with) {
                $query->with($with);
            })
            ->distinct(['products.id'])
            ->orderBy('availability')
            ->whereNot('availability', AvailableOptions::DISCONTINUED->value);

        if ($this->modelName == Category::class) {
            $all_category_ids = $this->all_category_ids;

            $query->where(function ($q) use ($all_category_ids) {
                $q->whereIn('products.id', function ($query) use ($all_category_ids) {
                    $query->select('product_id')
                        ->from('product_categories')
                        ->whereIn('category_id', $all_category_ids);
                })
                    ->orWhereIn('category_id', $all_category_ids);
            });
        } elseif ($this->modelName == Brand::class) {
            $query->where('brand_id', $this->brand->id);
        }

        return $query;
    }

    public function getFiltered()
    {
        $products = $this->getFilteredProductsQuery()
            ->selectRaw('case when user_favorite_products.product_id is null then FALSE else TRUE end as is_favourite');

        $sortColumn = $this->getSortColumn();
        if ($sortColumn == 'default') {
            $relation = $this->modelName == Brand::class ? $this->brand : $this->category;
            if ($relation->productSorts()->count() > 0) {
                $productSortIds = $relation->productSorts()->pluck('product_id')->implode(', ');
                $products->orderByRaw("IF(FIELD(products.id, $productSortIds)=0, 1, 0), FIELD(products.id, $productSortIds)");
            }
            $products->orderBy('created_at', 'DESC')->orderBy('products.id', 'desc');
        } else {
            $products->orderBy($sortColumn, $this->getSortDirection());
        }

        if (Auth::check()) {
            $favourites = DB::table('user_favorite_products')->select('user_favorite_products.*')->where('user_id', $this->request->user()->id);
            $products = $products->leftJoinSub($favourites, 'user_favorite_products', function (JoinClause $join) {
                $join->on('user_favorite_products.product_id', '=', 'products.id');
            });
        } else {
            $products = $products->leftJoin('user_favorite_products', 'user_favorite_products.product_id', '=', 'products.id');
        }

        $this->min_price = $this->products->min('price');
        $this->max_price = $this->products->max('price');

        return $products->paginate(self::PER_PAGE);
    }

    public function getFilteredProductsQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $price_from = $this->getPriceFrom();
        $price_to = $this->getPriceTo();

        $products = $this->getProductsQuery(['publishedComments', 'brand', 'values', 'baseProperty', 'basePropertyValue', 'product_variations', 'images'])
            ->when($search = $this->request->get('search'), function ($query) use($search) {
                $query
                    ->leftJoin('brands', 'brands.id', 'brand_id')
                    ->where(function ($query) use ($search) {
                    return $query->where('title', 'like', "%{$search}%")
                        ->orWhere('brands.name', 'like', '%'.$search.'%')
                        ->orWhere('code', 'like', '%'.$search.'%');
                });
            })
            ->when($properties = $this->getProperties(), function ($q) use ($properties) {
                $q->whereHas('values', function ($q) use($properties)  {
                    foreach ($properties as $property_id => $property_value_id)
                        $q->whereIn('property_value_id', $property_value_id);

                    return $q;
                });
            })
            ->when($brands = $this->request->get('brands'), function ($q) use ($brands) {
                $q->whereIn('brand_id', $brands);
            })
            ->when($category_id = $this->request->get('category_id'), function ($q) use ($category_id) {
                $q->where(function ($q) use ($category_id) {
                    $q->whereIn('products.id', function ($query) use ($category_id) {
                        $query->select('product_id')
                            ->from('product_categories')
                            ->where('category_id', $category_id);
                        })
                        ->orWhere('category_id', $category_id);
                });
            });


        $sql = $products->toSql();
        $bindings = $products->getBindings();
        $result = DB::select("SELECT MIN(price) as min_price, MAX(price) as max_price FROM ({$sql}) as subquery", $bindings);
        $this->min_filtered_price = $result[0]->min_price;
        $this->max_filtered_price = $result[0]->max_price;

        return $products
            ->where(function ($q) use ($price_from, $price_to) {
                $q->whereBetween('price', [
                    $price_from,
                    $price_to
                ])->orWhereBetween('old_price', [
                    $price_from,
                    $price_to
                ]);
            });
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
        $filters_weight = $this->getFiltersWeight($filters, $this->products);
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
        if (!$products) {
            $products = $this->products;
        }
        $productsArray = $products->pluck('values', 'id')->toArray();
        $result = [];

        foreach ($properties as $property) {
            $result[$property->id] = [];
            foreach ($property->values as $property_value) {
                $property_value_id = $property_value->id;
                $count = 0;
                foreach ($productsArray as $product) {
                    $exists = false;
                    foreach ($product as $value) {
                        if ($value['id'] == $property_value_id)
                            $exists = true;
                    }
                    if ($exists)
                        $count++;
                }
                $result[$property->id][$property_value->id] = $count;
            }
        }

        $result['brands'] = [];
        foreach (Brand::all() as $brand) {
            $result['brands'][$brand->id] = $products->where('brand_id', $brand->id)->count();
        }

        return $result;
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
        return request('search') || request('brands')
            || request('category_id') || request('properties');
    }


    public function getBrands()
    {
        return \App\Models\Brand::select(['id', 'name'])
            ->whereIn('id', array_unique($this->products->pluck('brand_id')->toArray()))
            ->orderBy('name')
            ->get();
    }

}
