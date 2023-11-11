<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\CatalogService;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{

    private CatalogService $catalogService;

    public function __construct(Request $request)
    {
        $this->catalogService = new CatalogService($request);
    }

    function index() {
        return view('categories.index_archived');
    }

    public function show(Request $request, string $alias) {
        $category = $this->catalogService->category;
        if (!$category->status) {
            abort(404);
        }
        $products = $this->catalogService->getFiltered();
        $properties = $this->catalogService->getFilters();
        $filters_weight = $this->catalogService->getFiltersWeight($properties);
        $min_price = $this->catalogService->min_price;
        $max_price = $this->catalogService->max_price;

        $products_id = [];
        foreach ($products as $product) {
            $products_id[] = $product->id;
        }
        $variations = Product::getVariations($products_id);

        if ($request->ajax()) {
            if ($request->has('load_more')) {
                $products_list = view('categories.parts.products', compact('products', 'variations'))->render();
                $pagination = view('categories.parts.pagination', compact('products'))->render();

                return response()->json([
                    'new_count' => $products->count(),
                    'products' => $products_list,
                    'pagination' => $pagination
                ]);
            } elseif ($request->has('load') || $request->has('change_page')) {
                $products_list = view('categories.parts.catalog', compact('products', 'variations'))->render();
            }

            return response()->json([
                'html' => $products_list,
                'filterCounts' => $filters_weight
            ]);
        } else {
            $products_list = view('categories.parts.catalog', compact('products', 'variations'))->render();
        }
        if ($request->ajax()) {
            return response()->json([
                'data' => $products_list,
                'next_link' => $products->nextPageUrl(),
                'current_page' => $products->currentPage()
            ]);
        }
        $last_page_url = $products->url($products->lastPage());
        $pagination = view('categories.parts.pagination', compact('products', 'last_page_url'))->render();
        return view('categories.index', compact('category', 'products', 'properties', 'filters_weight', 'pagination', 'products_list', 'min_price', 'max_price'));
    }
}
