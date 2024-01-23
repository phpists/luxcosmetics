<?php

namespace App\Listeners\Order;

use App\Events\OrderCreated;
use App\Models\DeliveryPoint;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FillAdditionalFields
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        if ($event->order->delivery_type == Order::DELIVERY_SELF_PICKUP) {
            if ($event->order->service == Order::DELIVERY_SERVICE_CDEK) {
                $likeAddress = $event->order->city . ', ' . $event->order->address . ', ' . $event->order->house;
                $deliveryPoint = DeliveryPoint::whereLms('cdek')
                    ->where('fullAddress', 'LIKE', "%{$likeAddress}%")
                    ->first();

                if ($deliveryPoint) {
                    $event->order->update([
                        'zip' => $deliveryPoint->zipCode,
                        'delivery_point_id' => $deliveryPoint->pointId,
                        'delivery_point_code' => $deliveryPoint->pointCode,
                    ]);
                }
            }
        }
    }
}
