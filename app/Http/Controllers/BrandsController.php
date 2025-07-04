<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Services\BrandsService;
use App\Services\CatalogService;
use Illuminate\Http\Request;

class BrandsController extends Controller
{

//    private CatalogService $catalogService;

//    public function __construct(Request $request)
//    {
//        $this->catalogService = new CatalogService($request, Brand::class);
//    }

    function index() {
        return view('brands.index_archived');
    }

    public function show(Request $request, string $link) {
        $brand = Brand::where('link', $link)->first();
        $category = Category::with(['tags', 'posts'])
            ->firstOrFail();

        return view('brands.lw-index', compact('brand', 'category'));

        $brands = $this->catalogService->brand;
        $category = $this->catalogService->category;
        $products = $this->catalogService->getFiltered();
        $properties = $this->catalogService->getFilters();
        $filters_weight = $this->catalogService->getFiltersWeight($properties);
        $filter_prices = $this->catalogService->getFilterPrices();
        $gridItems = $this->catalogService->getGridItems(collect($products->items()));

        $products_id = [];
        foreach ($products as $product) {
            $products_id[] = $product->id;
        }
        $variations = Product::getVariations($products_id);

        if ($request->ajax()) {
            if ($request->has('load_more')) {
                $products_list = view('categories.parts.products', compact('products', 'variations', 'gridItems'))->render();
                $pagination = view('categories.parts.pagination', compact('products'))->render();

                return response()->json([
                    'new_count' => $products->count(),
                    'products' => $products_list,
                    'pagination' => $pagination
                ]);
            } elseif ($request->has('load') || $request->has('change_page')) {
                $products_list = view('categories.parts.catalog', compact('products', 'variations', 'gridItems'))->render();
            }

            return response()->json([
                'html' => $products_list,
                'filterCounts' => $filters_weight,
                'filterPrices' => $filter_prices
            ]);
        } else {
            $products_list = view('categories.parts.catalog', compact('products', 'variations', 'gridItems'))->render();
        }
        if ($request->ajax()) {
            return response()->json([
                'data' => $products_list,
                'next_link' => $products->nextPageUrl(),
                'current_page' => $products->currentPage(),
                'filtered_prices' => $filter_prices,
            ]);
        }
        $last_page_url = $products->url($products->lastPage());
        $pagination = view('categories.parts.pagination', compact('products', 'last_page_url'))->render();
        return view('brands.index', compact('brands', 'category', 'filters_weight', 'properties',
            'products', 'pagination', 'products_list', 'filter_prices'));
    }
}
