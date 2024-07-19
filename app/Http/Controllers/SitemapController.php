<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\NewsItem;
use App\Models\Page;
use App\Models\Product;

class SitemapController extends Controller
{

    public function index()
    {
        return response()->view('sitemap.index', [
            'brands' => Brand::all(),
            'categories' => Category::all(),
            'products' => Product::all(),
            'pages' => Page::all(),
            'news' => NewsItem::all(),
            'banners' => Banner::all(),
        ])->header('Content-Type', 'text/xml');
    }

}
