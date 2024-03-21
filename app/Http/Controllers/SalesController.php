<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\CatalogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SalesController extends Controller
{
    private CatalogService $catalogService;

    public function __construct(Request $request)
    {
        $currentRoute = $request->route()->getName();
        $this->catalogService = new CatalogService($request, Category::class, $currentRoute);
    }

    public function index(Request $request) {
        $currentRoute = $request->route()->getName();
        $page_column = match ($currentRoute) {
            'sales' => 'show_in_sales_page',
            'sales-50' => 'show_in_percent_discount_page',
            'novinki' => 'show_in_new_page'
        };
        $currentCategory = Category::whereAlias($currentRoute)->first();
        if (!$currentCategory)
            abort(404);

        $products = $currentCategory->productsAsAdditional;
        $category_ids = [];

        foreach ($products as $product)
            $category_ids[] = $product->category_id;

        $categories = Category::whereIn('id', $category_ids)->distinct()->get();

        $selected_cat = $this->catalogService->category;
        $products = $this->catalogService->getFiltered();
        $properties = $this->catalogService->getFilters();
        $filters_weight = $this->catalogService->getFiltersWeight($properties);
        $brands = $this->catalogService->getBrands();
        $min_price = $this->catalogService->min_price;
        $max_price = $this->catalogService->max_price;

//        $categories = Category::query()
//            ->select('categories.*')
//            ->join('products', 'products.category_id', 'categories.id')
//            ->where($page_column, true)
//            ->distinct(['category_id'])
//            ->get();

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

//        $last_page_url = $products->url($products->lastPage());
//        $pagination = view('categories.parts.pagination', compact('products', 'last_page_url'))->render();
        return view('actions', compact('products', 'categories', 'selected_cat', 'properties',
            'brands', 'products_list', 'filters_weight', 'max_price', 'min_price', 'currentRoute'));
    }
}
