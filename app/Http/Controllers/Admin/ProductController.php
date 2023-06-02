<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Client\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::query()->get();
        return response()->view('admin.products.index', compact('products'));
    }

    public function create() {
        return response()->view('admin.products.create');
    }
}
