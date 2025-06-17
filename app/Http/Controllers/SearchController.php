<?php

namespace App\Http\Controllers;

use App\Enums\AvailableOptions;
use App\Models\Category;
use App\Models\Product;
use App\Services\CatalogService;
use App\Services\LanguageService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    private function search(Request $request): Builder
    {
        $search_query = $request->get('search');
        $per_page = $request->get('per-page') ?? 12;
        $sort = $request->get('sort') ?? 'desc';
        $from_price = ($request->price && array_key_exists('from', $request->price))? $request->price['from']: CatalogService::PRICE_FROM;
        $to_price = ($request->price && array_key_exists('to', $request->price))? $request->price['to']: CatalogService::PRICE_TO;
        $columns = $request->get('columns') ?? 2;

        return Product::query()
            ->titleSearch($search_query)
            ->where(function ($q) use ($from_price, $to_price) {
                $q->whereBetween('price', [
                    $from_price,
                    $to_price
                ])->orWhereBetween('old_price', [
                    $from_price,
                    $to_price
                ]);
            })
            ->whereNot('availability', AvailableOptions::DISCONTINUED->value)
            ->orderBy('availability')
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
        $search = $request->get('search');
        $base_property_id = $request->get('property_id');
        $products = Product::query()
            ->select(['products.*', 'property_value.value', 'properties.name', 'properties.measure'])
            ->whereNot('products.id', $request->get('product_id'))
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%'.$search.'%')
                        ->orWhere('code', 'like', '%'.$search.'%');
                });
            })
            ->where('base_property_id', $base_property_id)
            ->leftJoin('product_property_values', function ($join) use ($base_property_id) {
                $join->on('product_property_values.product_id', '=', 'products.id')
                    ->where('product_property_values.property_id', '=', DB::raw($base_property_id));
            })
            ->leftJoin('property_value', 'product_property_values.property_value_id', '=', 'property_value.id')
            ->leftJoin('properties', 'properties.id', '=', DB::raw($base_property_id))
            ->get();

        return response()->json($products);
    }

    public function showResultsPage(Request $request) {
        $search = $request->get('search');
        return view('lw-search', compact('search'));


        $catalogService = new CatalogService($request, Product::class);
        $products = $catalogService->getFiltered();
        $properties = $catalogService->getFilters();
        $filters_weight = $catalogService->getFiltersWeight($properties);
        $filter_prices = $catalogService->getFilterPrices();

//        $products = $this->search($request);
//        $products = $products
//            ->select('products.*', 'product_images.path as main_image')
//            ->join('product_images', 'products.image_print_id', 'product_images.id')
//            ->with('brand')
//            ->paginate($paginate_count);
        $products_id = [];
        foreach ($products as $product) {
            $products_id[] = $product->id;
        }
        $variations = Product::getVariations($products_id);

        $products_list = view('categories.parts.catalog', compact('products', 'variations'))->render();

        if ($request->ajax()) {
            if ($request->has('load_more')) {
                $products_list = view('categories.parts.products', compact('products', 'variations'))->render();
                $pagination = view('categories.parts.pagination', compact('products'))->render();

                return response()->json([
                    'new_count' => $products->count(),
                    'products' => $products_list,
                    'pagination' => $pagination
                ]);
            }

            return response()->json([
                'html' => $products_list,
                'filterCounts' => $filters_weight,
                'filterPrices' => $filter_prices
            ]);
        }

        $last_page_url = $products->url($products->lastPage());
        $pagination = view('layouts.includes.pagination', compact('products', 'last_page_url'))->render();

        return view('search', compact('products', 'properties', 'filters_weight', 'pagination', 'products_list', 'search', 'filter_prices'));
    }
    public function search_prompt(Request $request): JsonResponse
    {
        $products = $this->search($request)
            ->select('title', 'alias')
            ->get();

        return response()->json($products);
    }

}
