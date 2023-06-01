<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Client\Request;

class ProductController extends Controller
{
    public function show(Request $request, string $alias) {
        return response()->json(Product::all()->where('alias', $alias)->first());
    }
}
