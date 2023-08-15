<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comments;
use App\Models\Product;
use App\Models\Seo;
use App\Services\CatalogService;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        $relative_products = Product::query()
            ->select(['products.*', 'related_products.relation_type'])
            ->join('related_products', 'related_products.relative_product_id', 'products.id')
            ->where('related_products.product_id', $product->id)
            ->get();
        $random_products = Product::query()->inRandomOrder()->limit(12)->get();
        $product_variations = CatalogService::getProductVariations($product->id, $product->base_property_id);
        $comments = Comments::all();
        $ratings = Comments::pluck('rating');
        $averageRating = $ratings->avg();
        return view('products.product', compact('product', 'product_variations', 'articles', 'relative_products', 'random_products', 'comments', 'averageRating'));
    }

    public function productCard(Product $product)
    {
        return new JsonResponse([
            'html' => view('products._card', compact('product'))->render()
        ]);
    }

}
