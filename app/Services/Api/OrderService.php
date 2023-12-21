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
        $orders = Order::with(['orderProducts', 'giftProducts:article'])
            ->get();

        $orders = $orders->map(function ($order) {
            $order->delivery_method = $order->delivery_type;
            $order->delivery_type = $order->service;
            $order->shipping_method = "{$order->delivery_type}_{$order->delivery_method}";
            $order->products = $order->orderProducts->map(function (OrderProduct $orderProduct) {
                return [
                    'code' => $orderProduct->product->code,
                    'qty' => $orderProduct->quantity,
                    'price' => $orderProduct->price,
                    'sum' => $orderProduct->quantity * $orderProduct->price
                ];
            });
            $order->giftProducts = $order->giftProducts->map(function ($article) {
                return [
                    'code' => $article,
                    'qty' => 1,
                    'price' => 0,
                    'sum' => 0
                ];
            });
            $order->unsetRelation('orderProducts');

            return $order;
        });

        Order::whereIn('id', $orders->pluck('id'))->update(['is_received_by_1c' => 1]);
        return $orders;
    }

    /**
     * @throws \Exception
     */
    public function changeStatus(array $data, Order $order): void
    {
        $status = OrderStatus::firstOrCreate(['title' => $data['status_title']], ['color' => '#FFFFFF']);

        $order->status_id = $status->id;
        if (isset($data['note']))
            $order->note = $data['note'];

        if (!$order->save())
            throw new \Exception('Не удалось обновить статус!');
    }

}
