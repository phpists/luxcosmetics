<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Request $request, string $alias) {
        return view('products.product');
    }
}
