<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\BrandsService;
use Illuminate\Http\Request;

class BrandsController extends Controller
{

    private BrandsService $brandsService;

    public function __construct(Request $request)
    {
        $this->brandsService = new BrandsService($request);
    }

    function index() {
        return view('brands.index_archived');
    }

    public function show(Request $request, string $name) {
        $brands = $this->brandsService->brands;
        $category = $this->brandsService->category;
        $products = $this->brandsService->getFiltered();

        $products_id = [];
        foreach ($products as $product) {
            $products_id[] = $product->id;
        }
        $variations = Product::getVariations($products_id);

        if ($request->ajax()) {
            if ($request->has('load_more')) {
                $products_list = view('brands.parts.products', compact('products', 'variations'))->render();
                $pagination = view('brands.parts.pagination', compact('products'))->render();

                return response()->json([
                    'new_count' => $products->count(),
                    'products' => $products_list,
                    'pagination' => $pagination
                ]);
            } elseif ($request->has('load') || $request->has('change_page')) {
                $products_list = view('brands.parts.catalog', compact('products', 'variations'))->render();
            }

            return response()->json([
                'html' => $products_list
            ]);
        } else {
            $products_list = view('brands.parts.catalog', compact('products', 'variations'))->render();
        }
        if ($request->ajax()) {
            return response()->json([
                'data' => $products_list,
                'next_link' => $products->nextPageUrl(),
                'current_page' => $products->currentPage()
            ]);
        }
        $last_page_url = $products->url($products->lastPage());
        $pagination = view('brands.parts.pagination', compact('products', 'last_page_url'))->render();
        return view('brands.index', compact('brands', 'category', 'products', 'pagination', 'products_list'));
    }
}
