<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductFilterService
{

    const PER_PAGE = 12;
    const PRICE_FROM = 0;
    const PRICE_TO = 750000;

    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getProducts($filters = null)
    {

        $products = Product::query()
            ->selectRaw('products.*, product_images.path as main_image, case when user_favorite_products.product_id is null then FALSE else TRUE end as is_favourite')
            ->join('product_images', 'products.image_print_id', 'product_images.id')
//            ->whereIn('category_id', $category_ids)
            ->distinct(['products.id'])
            ->with('brand')
            ->where(function ($q) {
                $q->whereBetween('price', [
                    $this->getPriceFrom(),
                    $this->getPriceTo()
                ])->orWhereBetween('discount_price', [
                        $this->getPriceFrom(),
                        $this->getPriceTo()
                ]);
            });


        if ($properties = $this->getProperties()) {
            foreach ($properties as $property_id => $property_value_id) {
                $products->whereHas('values', function ($q) use($property_value_id)  {
                    return $q->whereIn('property_value_id', $property_value_id);
                });
            }
        }

        if (is_array($filters)) {
            foreach ($filters as $filter) {
                if (is_array($filter['value']) && count($filter['value']) > 0) {
                    $products->whereIn($filter['column'], $filter['value']);
                }
                else {
                    $products->where($filter['column'], $filter['value']);
                }
            }
        }

        if ($sort_column = $this->getSortColumn()) {
            $products->orderBy($sort_column, $this->getSortDirection());
        }

        if (Auth::check()) {
            $favourites = DB::table('user_favorite_products')->select('user_favorite_products.*')->where('user_id', $this->request->user()->id);
            $products = $products->leftJoinSub($favourites, 'user_favorite_products', function (JoinClause $join) {
                $join->on('user_favorite_products.product_id', '=', 'products.id');
            });
        }
        else {
            $products = $products->leftJoin('user_favorite_products', 'user_favorite_products.product_id', 'products.id');
        }

        return $products->paginate(self::PER_PAGE);
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
        return $this->request->get('price')['from'] ?? self::PRICE_FROM;
    }

    private function getPriceTo()
    {
        return $this->request->get('price')['to'] ?? self::PRICE_TO;
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
            ->select(['products.*', 'property_value.value as base_property_value', 'properties.name as  base_property_name', 'properties.measure as base_property_measure'])
            ->join('product_variations', 'product_variations.variation_id', 'products.id')
            ->where('product_variations.product_id', $product_id)
            ->join('product_property_values', function ($join) use ($base_property_id) {
                $join->on('product_property_values.product_id', '=', 'products.id')
                    ->where('product_property_values.property_id', '=', DB::raw($base_property_id));
            })
            ->join('property_value', 'product_property_values.property_value_id', '=', 'property_value.id')
            ->join('properties', 'properties.id', '=', DB::raw($base_property_id))
            ->get();
    }


}
