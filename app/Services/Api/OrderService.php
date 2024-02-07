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
        $orders = Order::newFor1C()
            ->with(['orderProducts', 'giftProducts:article'])
            ->get();

        $orders = $orders->map(function ($order) {
            $order->makeHiddenIf($order->delivery_type == Order::DELIVERY_COURIER, ['delivery_point_id', 'delivery_point_code']);

            $order->payment_method = 'checkmo';
            $order->delivery_method = $order->delivery_type;

            if ($order->delivery_type == Order::DELIVERY_SELF_PICKUP)
                $order->pickup_point_id = $order->delivery_point_id;

            $order->delivery_type = $order->deliveryMethod->name;

            $order->products = $order->orderProducts->map(function (OrderProduct $orderProduct) {
                return [
                    'code' => $orderProduct->product->code,
                    'qty' => $orderProduct->quantity,
                    'price' => $orderProduct->price,
                    'sum' => $orderProduct->quantity * $orderProduct->price
                ];
            });

            $order->gift_products = $order->giftProducts->map(function ($giftProduct) {
                return [
                    'code' => $giftProduct['article'],
                    'qty' => 1,
                    'price' => 0,
                    'sum' => 0
                ];
            });
            $order->unsetRelation('giftProducts');
            $order->unsetRelation('orderProducts');

            return $order;
        });

//        Order::whereIn('id', $orders->pluck('id'))->update(['is_received_by_1c' => 1]);
        return $orders;
    }

    /**
     * @throws \Exception
     */
    public function changeStatus(array $data, Order $order): void
    {
        $status = OrderStatus::firstOrCreate(
            ['title' => trim($data['status'])],
            ['color' => '#FFFFFF']
        );

        $order->status_id = $status->id;
        if (isset($data['note']))
            $order->note = $data['note'];

        if (!$order->save())
            throw new \Exception('Не удалось обновить статус!');
    }


    /**
     * @throws \Exception
     */
    public function receiveBy1c(Order $order, bool $is_received): void
    {
        $order->is_received_by_1c = $is_received;
        if (!$order->save())
            throw new \Exception('Не удалось сохранить результат!');
    }

}
