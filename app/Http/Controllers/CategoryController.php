<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function index() {
        return view('categories.index_archived');
    }

    public function show(Request $request, string $alias) {
        $query = Category::query();
        $query->where('alias', $alias);
        $category = $query->with('subcategories')->first();
        if (!$category) {
            abort('404');
        }
        $category_ids = [$category->id];
        foreach ($category->subcategories as $subcategory) {
            $category_ids[] = $subcategory->id;
        }
        $products = Product::query()
            ->select('products.*', 'images.path as image')
            ->join('images', 'products.image_print_id', 'images.id')
            ->whereIn('category_id', $category_ids)
            ->where('images.table_name', 'products')
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
        return view('categories.index', compact('category', 'products', 'pagination', 'products_list'));
    }
}
