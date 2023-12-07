<?php

namespace App\Services\Api;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use Illuminate\Database\Eloquent\Collection;

class OrderService
{

    public function getNewOrders()
    {
        $orders = Order::new()
            ->with(['orderProducts', 'giftProducts:article'])
            ->get();

        return $orders->map(function ($order) {
            $order->city = \Str::before($order->address, ',');
            $order->street = trim(\Str::after($order->address, ','));
            $order->products = $order->orderProducts->map(function (OrderProduct $orderProduct) {
                return [
                    'code' => $orderProduct->product->code,
                    'qty' => $orderProduct->quantity,
                    'price' => $orderProduct->price
                ];
            });
            $order->unsetRelation('orderProducts');

            return $order;
        });
    }

    /**
     * @throws \Exception
     */
    public function changeStatus(string $status_title, Order $order): void
    {
        $status = OrderStatus::firstOrCreate(['title' => $status_title], ['color' => '#FFFFFF']);

        $order->status_id = $status->id;
        if (!$order->save())
            throw new \Exception('Не удалось обновить статус!');
    }

}
