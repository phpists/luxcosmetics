<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index(): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user_statement = '';
        if (Auth::check()) {
            $user_statement = ' or user_favorite_products.user_id != '.Auth::user()->id;
        }
        $product_discounts = Product::query()
            ->selectRaw('products.*, product_images.path as image, case when user_favorite_products.product_id is null then FALSE else TRUE end as is_favourite')
            ->join('product_images', 'products.image_print_id', 'product_images.id')
            ->whereHas('product_variations', function ($query) {
                $query->whereNotNull('discount_price');
            })
            ->orWhereNotNull('products.discount_price')
            ->with('brand')
            ->with('product_variations')
            ->distinct(['products.id']);

        $new_products = Product::query()
            ->selectRaw('products.*, product_images.path as image, case when user_favorite_products.product_id is null'.$user_statement.' then FALSE else TRUE end as is_favourite')
            ->join('product_images', 'products.image_print_id', 'product_images.id')
            ->with('brand')
            ->with('product_variations')
            ->distinct(['products.id'])
            ->orderBy('created_at');

        if (Auth::check()) {
            $favourites = DB::table('user_favorite_products')->select('user_favorite_products.*')->where('user_id', request()->user()->id);
            $product_discounts = $product_discounts->leftJoinSub($favourites, 'user_favorite_products', function (JoinClause $join) {
                $join->on('user_favorite_products.product_id', '=', 'products.id');
            });
            $new_products = $new_products->leftJoinSub($favourites, 'user_favorite_products', function (JoinClause $join) {
                $join->on('user_favorite_products.product_id', '=', 'products.id');
            });
        }
        else {
            $product_discounts = $product_discounts->leftJoin('user_favorite_products', 'user_favorite_products.product_id', 'products.id');
            $new_products = $new_products->leftJoin('user_favorite_products', 'user_favorite_products.product_id', 'products.id');

        }
        $product_discounts = $product_discounts->limit(12)->get();
        $new_products = $new_products->limit(12)->get();
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
