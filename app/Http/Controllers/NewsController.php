<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;

class NewsController extends Controller
{
    public function show($id)
    {
        $item = NewsItem::findOrFail($id);
        return view('news', compact('item'));
    }
}
