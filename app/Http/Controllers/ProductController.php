<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Product;
use App\Services\CatalogService;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function show(Request $request, string $alias, int $variation_id = null) {
        $product = Product::query();
        $product = $product->where('alias', $alias)->firstOrFail();
        if ($request->ajax()) {
            $images = DB::table('product_images')
                ->select('path as image_path')
                ->where('record_id', $product->id)
                ->get();
            return response()->json([
                'product' => $product,
                'images' => $images
            ]);
        }
        $articles = Article::query()->where('record_id', $product->id)->where('table_name', 'products')->get();
        $category = $product->category;
        while (sizeof($articles) === 0) {
            $articles = Article::query()->where('record_id', $category->id)->where('table_name', 'categories')->get();
            if ($category->category_id !== null && sizeof($articles) === 0) {
                $category = Category::query()->find($category->category_id);
                if (!$category) {
                    break;
                }
            }
            else {
                break;
            }
        }
        $product_variations = CatalogService::getProductVariations($product->id, $product->base_property_id);
        return view('products.product', compact('product', 'product_variations', 'articles'));
    }
}
