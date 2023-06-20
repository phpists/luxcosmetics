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
        $products = Product::query()
            ->selectRaw('products.*, images.path as image, TRUE as is_favourite')
            ->join('images', 'products.image_print_id', 'images.id')
            ->join('user_favorite_products', 'user_favorite_products.product_id', 'products.id')
            ->where('images.table_name', 'products')
            ->with('brand')
            ->whereIn('products.id', FavoriteProductsService::getAllIds())
            ->groupBy('products.id')
            ->paginate(12);

        $products_id = [];
        foreach ($products as $product) {
            $products_id[] = $product->id;
        }
        $variations = Product::getVariations($products_id);

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
