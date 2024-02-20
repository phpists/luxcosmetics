<?php

namespace App\Services;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Property;
use App\Models\PropertyValue;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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

    public function __construct(Request $request, string $modelName, string $custom_alias = null)
    {
        $this->request = $request;
        $this->modelName = $modelName;

        if ($modelName == Category::class) {
            $alias = $custom_alias ?: $request->alias;
            $category = Category::where('alias', $alias)
                ->with(['subcategories', 'tags', 'posts'])
                ->firstOrFail();

            $this->category = $category;
            $this->all_category_ids = Category::getChildIds($category->id);
        } elseif ($modelName == Brand::class) {
            $category = Category::with(['subcategories', 'tags', 'posts'])
                ->firstOrFail();

            $this->category = $category;
            $this->brand = Brand::where('link', $request->link)->firstOrFail();
        }


        $this->products = $this->getProductsQuery()->get();
    }

    public function getProductsQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $all_category_ids = $this->all_category_ids;
        $query = $this->products_query = Product::query()
            ->select(['products.*', 'product_images.path as main_image'])
            ->leftJoin('product_images', 'products.image_print_id', 'product_images.id')
            ->with(['values', 'baseProperty', 'basePropertyValue'])
            ->distinct(['products.id']);

        if ($this->modelName == Category::class) {
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

        if ($sort_column = $this->getSortColumn()) {
            $products->orderBy($sort_column, $this->getSortDirection());
        }
        else {
            $products->orderBy('created_at', 'DESC')->orderBy('products.id', 'desc');
        }

        if (Auth::check()) {
            $favourites = DB::table('user_favorite_products')->select('user_favorite_products.*')->where('user_id', $this->request->user()->id);
            $products = $products->leftJoinSub($favourites, 'user_favorite_products', function (JoinClause $join) {
                $join->on('user_favorite_products.product_id', '=', 'products.id');
            });
        }
        else {
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

        $products = $this->getProductsQuery()
            ->when($search = $this->request->get('search'), function ($query) use($search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->where(function ($q) use ($price_from, $price_to) {
                $q->whereBetween('price', [
                    $price_from,
                    $price_to
                ])->orWhereBetween('old_price', [
                    $price_from,
                    $price_to
                ]);
            })
            ->when($properties = $this->getProperties(), function ($q) use ($properties) {
                foreach ($properties as $property_id => $property_value_id) {
                    $q->whereHas('values', function ($q) use($property_value_id)  {
                        return $q->whereIn('property_value_id', $property_value_id);
                    });
                }
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

        return $products;
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

    private function getPriceFrom()
    {
        return $this->request->get('price')['from'] ?? $this->products->min('price');
    }

    private function getPriceTo()
    {
        return $this->request->get('price')['to'] ?? $this->products->max('price');
    }

    private function getSortColumn()
    {
        return explode(':', $this->request->get('sort'))[0] ?? null;
    }

    private function getSortDirection()
    {
        return explode(':', $this->request->get('sort'))[1] ?? null;
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

        $products = $this->products;

        return $filters->filter(function ($property) use ($products) {
            $include = false;
            $products->map(function ($product) use ($property, $include) {
                $products_with_property = $product->values->filter(function ($product_value) use ($property, $include) {
                    Arr::has($property->values->pluck('id')->toArray(), $product_value->id);
                });
                if ($products_with_property->isNotEmpty()) {
                    $include = true;
                }
            });

            return $include;
        });
    }

    public function getFiltersWeight($properties, $products = null): array
    {
        if (!$products) {
            $products = $this->getFilteredProductsQuery()->get();
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

    public function getBrands()
    {
        return \App\Models\Brand::select(['id', 'name'])
            ->whereIn('id', $this->products->pluck('brand_id')->toArray())
            ->orderBy('name')
            ->get();
    }

}
