<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index() {
        $brands = Brand::query()
            ->whereHas('products')
            ->selectRaw('brands.*, LOWER(SUBSTR(brands.name, 1, 1)) as letter')
            ->orderByRaw('name')
            ->get();

        return view('brands', compact('brands'));
    }
}
