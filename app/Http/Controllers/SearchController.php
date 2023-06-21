<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\LanguageService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    private function search(Request $request): Builder
    {
        $search_query = $request->get('search');
        $per_page = $request->get('per-page') ?? 12;
        $sort = $request->get('sort') ?? 'desc';
        $columns = $request->get('columns') ?? 2;

        return Product::query()
            ->where('title', 'like', '%'.$search_query.'%')
            ->limit($per_page);
    }

    public function index(Request $request): JsonResponse
    {
        $products = $this->search($request)
            ->select('id', 'title')
            ->get();

        return response()->json($products);
    }

    public function showResultsPage(Request $request) {
        $search = $request->get('search');
        $products = $this->search($request);
        $products = $products
            ->select('products.*', 'product_images.path as main_image')
            ->join('product_images', 'products.image_print_id', 'product_images.id')
            ->with('brand')
            ->paginate(12);
        $products_id = [];
        foreach ($products as $product) {
            $products_id[] = $product->id;
        }
        $variations = Product::getVariations($products_id);
        $products_list = view('categories.parts.products', compact('products', 'variations'))->render();

        if ($request->ajax()) {
            return response()->json([
                'data' => $products_list,
                'next_link' => $products->nextPageUrl(),
                'current_page' => $products->currentPage()
            ]);
        }
        $last_page_url = $products->url($products->lastPage());
        $pagination = view('categories.parts.pagination', compact('products', 'last_page_url'))->render();
        return view('search', compact('products', 'pagination', 'products_list', 'search'));
    }
    public function search_prompt(Request $request): JsonResponse
    {
        $products = $this->search($request)
            ->select('title', 'alias')
            ->get();

        return response()->json($products);
    }

}
