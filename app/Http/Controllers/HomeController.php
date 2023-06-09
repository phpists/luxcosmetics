<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $product_discounts = Product::query()
            ->select('products.*', 'images.path as image')
            ->join('images', 'products.image_print_id', 'images.id')
            ->where('images.table_name', 'products')
            ->whereHas('product_variations', function ($query) {
                $query->whereNotNull('discount_price');
            })
            ->orWhereNotNull('products.discount_price')
            ->with('brand')
            ->with('product_variations')
            ->limit(12)->get();
        $new_products = Product::query()
            ->select('products.*', 'images.path as image')
            ->join('images', 'products.image_print_id', 'images.id')
            ->where('images.table_name', 'products')
            ->with('brand')
            ->with('product_variations')
            ->orderBy('created_at')->limit(12)->get();
        return view('index', compact('product_discounts', 'new_products'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        return view('home');
    }
}
