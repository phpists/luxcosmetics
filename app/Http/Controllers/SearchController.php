<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\LanguageService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function getProductsByBaseValue(Request $request): JsonResponse
    {
        $base_property_id = $request->get('property_id');
        $products = Product::query()
            ->select(['products.*', 'property_value.value', 'properties.name', 'properties.measure'])
            ->whereNot('products.id', $request->get('product_id'))
            ->where('title', 'like', '%'.$request->get('search').'%')
            ->where('base_property_id', $base_property_id)
            ->join('product_property_values', function ($join) use ($base_property_id) {
                $join->on('product_property_values.product_id', '=', 'products.id')
                    ->where('product_property_values.property_id', '=', DB::raw($base_property_id));
            })
            ->join('property_value', 'product_property_values.property_value_id', '=', 'property_value.id')
            ->join('properties', 'properties.id', '=', DB::raw($base_property_id))
            ->get();

        return response()->json($products);
    }

    public function showResultsPage(Request $request) {
        $paginate_count = 12;
        $search = $request->get('search');
        $products = $this->search($request);
        $products = $products
            ->select('products.*', 'product_images.path as main_image')
            ->join('product_images', 'products.image_print_id', 'product_images.id')
            ->with('brand')
            ->paginate($paginate_count);
        $products_id = [];
        foreach ($products as $product) {
            $products_id[] = $product->id;
        }
        $variations = Product::getVariations($products_id);
        $products_list = view('categories.parts.products', compact('products', 'variations'))->render();
        $shown_count = ($products->currentPage() - 1) * $paginate_count + $products->count();
        if ($request->ajax()) {
            return response()->json([
                'data' => $products_list,
                'next_link' => $products->nextPageUrl(),
                'current_page' => $products->currentPage(),
                'shown_count' => $shown_count
            ]);
        }
        $last_page_url = $products->url($products->lastPage());
        $pagination = view('categories.parts.pagination', compact('products', 'last_page_url'))->render();
        return view('search', compact('products', 'pagination', 'products_list', 'search', 'shown_count'));
    }
    public function search_prompt(Request $request): JsonResponse
    {
        $products = $this->search($request)
            ->select('title', 'alias')
            ->get();

        return response()->json($products);
    }

}
