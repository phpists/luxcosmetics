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
        $products = $this->catalogService->getFiltered();

        $products_id = [];
        foreach ($products as $product) {
            $products_id[] = $product->id;
        }
        $variations = Product::getVariations($products_id);

        if ($request->ajax() && $request->has('page')) {
            $products_list = view('categories.parts.products', compact('products', 'variations'))->render();
        } elseif ($request->ajax() && $request->has('load')) {
            $products_list = view('categories.parts.catalog', compact('products', 'variations'))->render();
            return response()->json([
                'html' => $products_list
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
        return view('categories.index', compact('category', 'products', 'pagination', 'products_list'));
    }
}
