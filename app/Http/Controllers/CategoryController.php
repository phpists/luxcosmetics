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
        $category_ids = [$category->id];
        foreach ($category->subcategories as $subcategory) {
            $category_ids[] = $subcategory->id;
        }
        $products = Product::query()
            ->select('products.*', 'images.path as image')
            ->join('images', 'products.image_print_id', 'images.id')
            ->whereIn('category_id', $category_ids)
            ->where('images.table_name', 'products')
            ->with('product_variations')
            ->with('brand')
            ->get();
        return view('categories.index', compact('category', 'products'));
    }
}
