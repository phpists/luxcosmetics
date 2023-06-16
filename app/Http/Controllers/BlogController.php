<?php

namespace App\Http\Controllers;

use App\Models\BlogItem;

class BlogController extends Controller
{
    public function show($link)
    {
        $item = BlogItem::where('link', $link)->firstOrFail();
        return view('blog', compact('item'));
    }
}
