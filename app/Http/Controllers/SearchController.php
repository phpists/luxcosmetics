<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\LanguageService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    private function search(Request $request): Builder
    {
        $search_query = $request->get('search');
        $per_page = $request->get('per-page') ?? 12;
        $sort = $request->get('sort') ?? 'desc';
        $columns = $request->get('columns') ?? 2;

        return Product::query()
            ->where('title', 'like', '%'.$search_query.'%')
            ->limit($per_page);
    }

    public function index(Request $request): JsonResponse
    {
        $products = $this->search($request)
            ->select('id', 'title')
            ->get();

        return response()->json($products);
    }
    public function search_prompt(Request $request): JsonResponse
    {
        $products = $this->search($request)
            ->select('title', 'alias')
            ->get();

        return response()->json($products);
    }

}
