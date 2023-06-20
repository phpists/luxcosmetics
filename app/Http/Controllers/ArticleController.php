<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function show($link)
    {
        $item = Article::where('link', $link)->firstOrFail();
        return view('article', compact('item'));
    }
}
