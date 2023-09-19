<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderProductController extends Controller
{

    // Product
    public function add(Request $request)
    {
        $id = $request->post('id');
        $quantity = $request->post('quantity');
        $products = $request->post('products') ?? [];

        $isset = false;
        foreach ($products as &$item) {
            if ($item['product_id'] == $id) {
                $item['quantity'] += $quantity;
                $isset = true;
                break;
            }
        }

        if (!$isset) {
            $product = Product::findOrFail($id);

            $currentOrderProduct = [
                'product_id' => $id,
                'quantity' => $quantity,
                'price' => $product->price
            ];
            if ($product->old_price)
                $currentOrderProduct['old_price'] = $product->old_price;

            $products[] = $currentOrderProduct;
        }

        $products = collect($products);

        if ($request->wantsJson()) {
            $bonuses = $request->get('bonuses', 0);
            $total_sum = $products->sum(function ($item) {
                    return $item['quantity'] * $item['price'];
                });
            $html = view('admin.orders.includes.products', [
                'orderProducts' => $products,
                'total_sum' => $total_sum - $bonuses,
                'bonuses' => $bonuses
            ])->render();

            return new JsonResponse([
                'result' => true,
                'products' => $products,
                'html' => $html
            ]);
        }

        return back();
    }

    public function refresh(Request $request)
    {
        $products = collect($request->post('products'));

        if ($request->wantsJson()) {
            $bonuses = $request->get('bonuses', 0);
            $total_sum = $products->sum(function ($item) {
                    return $item['quantity'] * $item['price'];
                });
            $html = view('admin.orders.includes.products', [
                'orderProducts' => $products,
                'total_sum' => $total_sum - $bonuses,
                'bonuses' => $bonuses
            ])->render();

            return new JsonResponse([
                'result' => true,
                'products' => $products,
                'html' => $html
            ]);
        }

        return back();
    }

    public function destroy(Request $request, OrderProduct $orderProduct)
    {
        if ($request->wantsJson()) {
            return new JsonResponse([
                'result' => $orderProduct->delete()
            ]);
        }

        return back();
    }

}
