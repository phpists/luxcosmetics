<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\LanguageService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search_prompt(Request $request)
    {
        $search_query = $request->get('search');
        $per_page = $request->get('per-page') ?? 6;
        $sort = $request->get('sort') ?? 'desc';
        $columns = $request->get('columns') ?? 2;

        $products = Product::query()
            ->select('title', 'alias')
            ->where('title', 'like', '%'.$search_query.'%')
            ->limit($per_page)
            ->get();

        return response()->json($products);

    }

}
