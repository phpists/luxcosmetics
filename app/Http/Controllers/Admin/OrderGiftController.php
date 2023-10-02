<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\GiftService;
use Illuminate\Http\Request;

class OrderGiftController extends Controller
{

    public function table(Request $request)
    {
        $cart_products = collect($request->post('products', []));
        $products = Product::find($cart_products->pluck('product_id'));

        $giftService = new GiftService();
        $gift_products = $giftService->getGiftProducts($products);

        if ($request->pjax())
            return view('admin.orders.includes.gifts', compact('gift_products'));

        return back();
    }

}
