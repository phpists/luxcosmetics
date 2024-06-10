<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Services\FavoriteProductsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FavoriteProductController extends Controller
{

    private function getProducts($categoryId = null) {
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
                ->when($categoryId, function ($query, $categoryId) {
                    $query->where('products.category_id', $categoryId);
                })
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
    public function index(string $categoryId = null)
    {
        $data = $this->getProducts($categoryId);
        $products = $data['products'];
        $variations = $data['variations'];

        $categories = Category::whereIn('id', $this->getProducts()['products']->pluck('category_id'))->get();

        return view('favourite-products', compact('products', 'variations', 'categories', 'categoryId'));
    }

    public function add(Request $request)
    {
        return \Response::json([
            'result' => true,
            'total_count' => FavoriteProductsService::setById($request->post('id')),
            'message' => 'Товар добавлен в избранное'
        ]);
    }

    public function remove(Request $request)
    {
        $count = FavoriteProductsService::removeById($request->post('id'));
        if ($request->refresh) {
            $data = $this->getProducts();
            $products = $data['products'];
            $variations = $data['variations'];
            $productsHtml = view('categories.parts.products', ['products' => $products, 'variations' => $variations, 'is_favourite_page' => true])->render();
            $paginateHtml = view('categories.parts.pagination', ['products' => $products])->render();
            return response()->json([
                'productsHtml' => $productsHtml,
                'paginateHtml' => $paginateHtml,
                'count' => $count
            ]);
        }

        return \Response::json([
            'result' => true,
            'total_count' => $count,
            'message' => 'Товар удален из избранного'
        ]);
    }

}
