<?php

namespace App\Services\Api;

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Database\Eloquent\Collection;

class OrderService
{

    public function getNewOrders(): Collection
    {
        return Order::new()
            ->with(['products:code', 'giftProducts:article'])
            ->get();
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
