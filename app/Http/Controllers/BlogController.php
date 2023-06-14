<?php

namespace App\Http\Controllers;

use App\Models\BlogItem;

class BlogController extends Controller
{
    public function show($id)
    {
        $item = BlogItem::findOrFail($id);
        return view('blog', compact('item'));
    }
}
