<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{
    public function show(Request $request) {
        $image = DB::table('images')->find($request->id);
        $image->is_main = 0;
        $product = DB::table('products')->find($image->record_id);
        if ($product) {
            $image->is_main = $product->image_print_id === $image->id  ? 1:0;
        }

        return response()->json($image);
    }
}
