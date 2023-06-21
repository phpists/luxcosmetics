<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\FavoriteProductsService;
use Illuminate\Http\Request;

class FavoriteProductController extends Controller
{

    public function index()
    {
        $products_id = FavoriteProductsService::getAllIds();
        $products = [];
        $variations = [];
        if (sizeof($products_id) > 0) {
            $products = Product::query()
                ->selectRaw('products.*, product_images.path as main_image, TRUE as is_favourite')
                ->leftJoin('user_favorite_products', 'user_favorite_products.product_id', 'products.id')
                ->join('product_images', 'products.image_print_id', 'product_images.id')
                ->with('brand')
                ->whereIn('products.id', FavoriteProductsService::getAllIds())
                ->groupBy('products.id')
                ->paginate(12);

            $products_id = [];
            foreach ($products as $product) {
                $products_id[] = $product->id;
            }
            $variations = Product::getVariations($products_id);
        }
        return view('favourite-products', compact('products', 'variations'));
    }

    public function add(Request $request)
    {
        return FavoriteProductsService::setById($request->post('id'));
    }

    public function remove(Request $request)
    {
        return FavoriteProductsService::removeById($request->post('id'));
    }

}
