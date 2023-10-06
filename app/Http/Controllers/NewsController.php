<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;

class NewsController extends Controller
{
    public function index()
    {
        $posts = NewsItem::query()->paginate(24);
        return view('news', compact('posts'));
    }
    public function show($link)
    {
        $item = NewsItem::where('link', $link)->firstOrFail();
        return view('news-post', compact('item'));
    }
}
