<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\FavoriteProductsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FavoriteProductController extends Controller
{

    private function getProducts() {
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
                ->distinct(['products.id'])
                ->paginate(12);

            $products_id = [];
            foreach ($products as $product) {
                $products_id[] = $product->id;
            }
            $variations = Product::getVariations($products_id);
        }
        return [
            'products' => $products,
            'variations' => $variations
        ];
    }
    public function index()
    {
        $data = $this->getProducts();
        $products = $data['products'];
        $variations = $data['variations'];
        return view('favourite-products', compact('products', 'variations'));
    }

    public function add(Request $request)
    {
        return FavoriteProductsService::setById($request->post('id'));
    }

    public function remove(Request $request)
    {
        $count = FavoriteProductsService::removeById($request->post('id'));
        if ($request->refresh) {
            $data = $this->getProducts();
            $products = $data['products'];
            $variations = $data['variations'];
            $productsHtml = view('categories.parts.products', ['products' => $products, 'variations' => $variations])->render();
            $paginateHtml = view('categories.parts.pagination', ['products' => $products])->render();
            return response()->json([
                'productsHtml' => $productsHtml,
                'paginateHtml' => $paginateHtml,
                'count' => $count
            ]);
        }
        return $count;
    }

}
