<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Request $request, string $alias) {
        $product = Product::query();
        $product = $product->where('alias', $alias)->first();

        return view('products.product', compact('product'));
    }
}
