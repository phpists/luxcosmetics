<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;

class NewsController extends Controller
{
    public function show($link)
    {
        $item = NewsItem::where('link', $link)->firstOrFail();
        return view('news', compact('item'));
    }
}
