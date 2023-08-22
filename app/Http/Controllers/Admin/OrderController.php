<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->paginate();
        $statuses = OrderStatus::all();

        return view('admin.orders.index', compact('orders', 'statuses'));
    }

    public function create()
    {
        return view('admin.orders.create', [
            'order' => new Order()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->post();
        $data['as_delivery_address'] = $request->boolean('as_delivery_address');
        $data['gift_box'] = $request->boolean('gift_box');
        $orderProducts = collect($data['products']);
        unset($data['products']);

        $data['total_sum'] = $orderProducts->sum(function ($item) {
            return $item['quantity'] * $item['price'];
        });
        $order = Order::create($data);

        foreach ($orderProducts as $orderProduct) {
            $newProduct = [
                'order_id' => $order->id,
                'product_id' => $orderProduct['product_id'],
                'quantity' => $orderProduct['quantity'],
                'price' => $orderProduct['price'],
            ];
            if (isset($orderProduct['old_price']))
                $newProduct['old_price'] = $orderProduct['old_price'];

            OrderProduct::create($newProduct);
        }

        return redirect()->route('admin.orders.edit', $order)
            ->with('success', 'Заказ успешно создан');
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', [
            'order' => $order,
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->post();
        $data['as_delivery_address'] = $request->boolean('as_delivery_address');
        $data['gift_box'] = $request->boolean('gift_box');
        $orderProducts = collect($data['products']);
        unset($data['products']);

        foreach ($orderProducts as $orderProduct) {
            if (isset($orderProduct['id'])) {
                $product = OrderProduct::find($orderProduct['id']);
                $product->update(['quantity' => $orderProduct['quantity']]);
            } else {
                $newProduct = [
                    'order_id' => $order->id,
                    'product_id' => $orderProduct['product_id'],
                    'quantity' => $orderProduct['quantity'],
                    'price' => $orderProduct['price'],
                ];
                if (isset($orderProduct['old_price']))
                    $newProduct['old_price'] = $orderProduct['old_price'];

                OrderProduct::create($newProduct);
            }
        }

        $data['total_sum'] = $orderProducts->sum(function ($item) {
            return $item['quantity'] * $item['price'];
        });

        $order->update($data);

        return back()->with('success', 'Заказ успешно обновлён');
    }

    public function changeStatus(Request $request, Order $order)
    {
        return $order->update(['status_id' => $request->post('status_id')]);
    }

}
