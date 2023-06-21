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
            ->selectRaw('products.*, product_images.path as image, case when user_favorite_products.product_id is null then FALSE else TRUE end as is_favourite')
            ->leftJoin('user_favorite_products', 'user_favorite_products.product_id', 'products.id')
            ->join('product_images', 'products.image_print_id', 'product_images.id')
            ->whereHas('product_variations', function ($query) {
                $query->whereNotNull('discount_price');
            })
            ->orWhereNotNull('products.discount_price')
            ->with('brand')
            ->with('product_variations')
            ->groupBy('products.id')
            ->limit(12)->get();
        $new_products = Product::query()
            ->selectRaw('products.*, product_images.path as image, case when user_favorite_products.product_id is null then FALSE else TRUE end as is_favourite')
            ->leftJoin('user_favorite_products', 'user_favorite_products.product_id', 'products.id')
            ->join('product_images', 'products.image_print_id', 'product_images.id')
            ->with('brand')
            ->with('product_variations')
            ->groupBy('products.id')
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
