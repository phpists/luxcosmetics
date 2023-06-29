<?php

namespace App\Services;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BrandsService
{

    const PER_PAGE = 12;
    const PRICE_FROM = 0;
    const PRICE_TO = 750000;

    public $request;
    public $category;
    public $brands;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $brands = Brand::where('name', $request->name)->firstOrFail();
        $category = Category::with(['subcategories', 'tags'])->firstOrFail();
        
        $this->category = $category;
        $this->brands = $brands;
    }

    public function getFiltered()
    {
        $brandId = $this->brands->id;
        
        $products = Product::query()
            ->selectRaw('products.*, product_images.path as main_image, case when user_favorite_products.product_id is null then FALSE else TRUE end as is_favourite')
            ->join('product_images', 'products.image_print_id', 'product_images.id')
            ->whereIn('category_id', $this->getCategoryIds())
            ->where('brand_id', $brandId)
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
            foreach ($properties as $propertyId => $propertyValueId) {
                $products->whereHas('values', function ($q) use ($propertyValueId) {
                    return $q->whereIn('property_value_id', $propertyValueId);
                });
            }
        }

        if ($sortColumn = $this->getSortColumn()) {
            $products->orderBy($sortColumn, $this->getSortDirection());
        }

        if (Auth::check()) {
            $favourites = DB::table('user_favorite_products')->select('user_favorite_products.*')->where('user_id', $this->request->user()->id);
            $products = $products->leftJoinSub($favourites, 'user_favorite_products', function (JoinClause $join) {
                $join->on('user_favorite_products.product_id', '=', 'products.id');
            });
        } else {
            $products = $products->leftJoin('user_favorite_products', 'user_favorite_products.product_id', 'products.id');
        }

        return $products->paginate(self::PER_PAGE);
    }

    private function getCategoryIds()
    {
        $categoryIds = [$this->category->id];
        foreach ($this->category->subcategories as $subcategory) {
            $categoryIds[] = $subcategory->id;
        }
        return $categoryIds;
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

}
