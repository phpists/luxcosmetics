<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function show(Request $request, string $alias, int $variation_id = null) {
        $product = Product::query();
        $product = $product->where('alias', $alias)->first();
        $product_variations = $product->product_variations;
        $selected_variation = $product_variations->find($variation_id)??$product_variations->first();
        $selected_variation = $selected_variation??$product;
        return view('products.product', compact('product', 'selected_variation'));
    }
}
