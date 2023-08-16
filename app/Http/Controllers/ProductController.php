<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comments;
use App\Models\Product;
use App\Models\ProductQuestion;
use App\Models\Seo;
use App\Services\CatalogService;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $questions = ProductQuestion::query()
            ->select(['product_questions.*', 'comments_actions.is_like as is_like'])
            ->leftJoin('comments_actions', 'comments_actions.record_id', 'product_questions.id')
            ->where('product_id', $product->id)
            ->where('comments_actions.table_name', 'product_questions')
            ->where('status', '>', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(ProductQuestion::ITEMS_PER_PAGE);
        $has_more_questions = $questions->hasMorePages();
        $random_products = Product::query()->inRandomOrder()->limit(12)->get();
        $product_variations = CatalogService::getProductVariations($product->id, $product->base_property_id);
        $user = null;
        if (Auth::check()) {
            $user = $request->user();
        }
        $comments = Comments::query()
            ->where('product_id', $product->id)
            ->where('status', 'Опубликовать')
            ->orderBy('created_at', 'desc')
            ->paginate(ProductQuestion::ITEMS_PER_PAGE);

        $ratings = Comments::where('product_id', $product->id)->pluck('rating');
        $averageRating = $ratings->avg();

        return view('products.product', compact('product', 'product_variations', 'articles', 'relative_products', 'random_products', 'comments', 'averageRating',  'questions', 'has_more_questions', 'user'));
    }

    public function productCard(Product $product)
    {
        return new JsonResponse([
            'html' => view('products._card', compact('product'))->render()
        ]);
    }

}
