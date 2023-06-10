<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;
use App\Services\LanguageService;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function show(Request $request, $locale, $article)
    {
        $item = NewsItem::select('news_item.*');

        if (!$item) {
            abort(404);
        }

        return view('index', compact('item'));
    }

    public function search(Request $request)
    {
        $q = $request->get('search');
        $query = NewsItem::query();
        $query->groupBy('news_item.id');

        $newses = $query->paginate(20);

        return response()->json(view('index', compact('newses'))->render());
    }

}
