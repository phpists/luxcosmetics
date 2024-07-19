<?php

namespace App\Http\Controllers;

use App\Models\MainPageBlock;
use App\Models\Product;
use App\Services\SiteConfigService;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\JoinClause;
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

        $auto_popular = (bool)SiteConfigService::getParamValue('автоматически_популярные');
        $auto_new = (bool)SiteConfigService::getParamValue('автоматически_новые');
        $auto_discount = (bool)SiteConfigService::getParamValue('автоматически_со_скидкой');

        $product_discounts = Product::query()
            ->selectRaw('products.*, product_images.path as main_image, case when user_favorite_products.product_id is null then FALSE else TRUE end as is_favourite')
            ->join('product_images', 'products.image_print_id', 'product_images.id');

        if ($auto_discount) {
            $product_discounts = $product_discounts
                ->whereHas('product_variations', function ($query) {
                    $query->whereNotNull('discount_price');
                })
                ->orWhereNotNull('products.discount_price');
        }
        else {
            $product_discounts = $product_discounts->where('show_in_discount', true);
        }

        $product_discounts = $product_discounts
            ->with('brand')
            ->with('product_variations')
            ->distinct(['products.id']);

        $new_products = Product::query()
            ->selectRaw('products.*, product_images.path as main_image, case when user_favorite_products.product_id is null'.$user_statement.' then FALSE else TRUE end as is_favourite')
            ->join('product_images', 'products.image_print_id', 'product_images.id')
            ->with('brand')
            ->with('product_variations')
            ->distinct(['products.id']);

        if ($auto_new) {
            $new_products = $new_products->orderBy('created_at', 'DESC');
        }
        else {
            $new_products = $new_products->where('show_in_new', true);
        }

        $popular_products = Product::query()
            ->selectRaw('products.*, product_images.path as main_image, case when user_favorite_products.product_id is null'.$user_statement.' then FALSE else TRUE end as is_favourite')
            ->join('product_images', 'products.image_print_id', 'product_images.id')
            ->with('brand')
            ->with('product_variations')
            ->distinct(['products.id']);

        if ($auto_popular) {
            $popular_products = $popular_products->orderBy('created_at');
        }
        else {
            $popular_products = $popular_products->where('show_in_popular', true);
        }

        if (Auth::check()) {
            $favourites = DB::table('user_favorite_products')->select('user_favorite_products.*')->where('user_id', request()->user()->id);
            $product_discounts = $product_discounts->leftJoinSub($favourites, 'user_favorite_products', function (JoinClause $join) {
                $join->on('user_favorite_products.product_id', '=', 'products.id');
            });
            $new_products = $new_products->leftJoinSub($favourites, 'user_favorite_products', function (JoinClause $join) {
                $join->on('user_favorite_products.product_id', '=', 'products.id');
            });
            $popular_products = $popular_products->leftJoinSub($favourites, 'user_favorite_products', function (JoinClause $join) {
                $join->on('user_favorite_products.product_id', '=', 'products.id');
            });
        }
        else {
            $product_discounts = $product_discounts->leftJoin('user_favorite_products', 'user_favorite_products.product_id', 'products.id');
            $new_products = $new_products->leftJoin('user_favorite_products', 'user_favorite_products.product_id', 'products.id');
            $popular_products = $popular_products->leftJoin('user_favorite_products', 'user_favorite_products.product_id', 'products.id');;
        }
        $product_discounts = $product_discounts->limit((int)SiteConfigService::getParamValue('карусель_скидки'))->get();
        $new_products = $new_products->limit((int)SiteConfigService::getParamValue('карусель_новые'))->get();
        $popular_products = $popular_products->limit((int)SiteConfigService::getParamValue('карусель_популярные'))->get();

        $main_block = MainPageBlock::query()->first();
        return view('index', compact('product_discounts', 'new_products', 'popular_products', 'main_block'));
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
