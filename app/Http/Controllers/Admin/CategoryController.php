<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Request $request, string $alias) {
        $query = Category::query();
        $query->where('alias', $alias);
        $category = $query->with('subcategories')->first();
        return response()->json($category);
    }
}
