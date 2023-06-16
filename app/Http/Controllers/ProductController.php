<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function show(Request $request, string $alias, int $variation_id = null) {
        $product = Product::query();
        $product = $product->where('alias', $alias)->firstOrFail();
        if ($request->ajax()) {
            $images = DB::table('images')
                ->select('path as image_path')
                ->where('record_id', $product->id)
                ->where('table_name', 'products')
                ->get();
            return response()->json([
                'product' => $product,
                'images' => $images
            ]);
        }
        $product_variations = Product::query()
            ->select('products.*')
            ->join('product_variations', 'product_variations.variation_id', 'products.id')
            ->where('product_variations.product_id', $product->id)
            ->get();
        return view('products.product', compact('product', 'product_variations'));
    }
}
