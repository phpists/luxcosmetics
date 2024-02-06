<?php

namespace App\Jobs\Order;

use App\Models\CourierDeliveryMethod;
use App\Models\DeliveryPoint;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class FillAdditionalFields implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Order $order)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $order = $this->order;

        if ($order->delivery_type == Order::DELIVERY_SELF_PICKUP) {
            $deliveryPoint = DeliveryPoint::whereLms($order->deliveryMethod->name)
                ->whereCityname($order->city)
                ->where(function ($q) use($order) {
                    $formattedStreet = $this->clearStreet($order->street);

                    $q->where('fullAddress', 'LIKE', "%{$formattedStreet}%")
                        ->where('fullAddress', 'LIKE', "%{$order->house}%");
                })
                ->first();

            if ($deliveryPoint) {
                $order->update([
                    'zip' => $deliveryPoint->zipCode,
                    'delivery_point_id' => $deliveryPoint->pointId,
                    'delivery_point_code' => $deliveryPoint->pointCode,
                    'shipping_method' => $deliveryPoint->lms . '_' . $order->delivery_type
                ]);
            }
        } elseif ($order->delivery_type == Order::DELIVERY_COURIER) {
            $state = null;
            if (str_contains($order->city, 'обл')) {
                [$city, $state] = explode(',', $order->city);
            } else {
                $city = $order->city;
            }

            $courierDeliveryMethod = CourierDeliveryMethod::whereJsonContains('cities', trim($city))->first();
            if (!$courierDeliveryMethod && $state)
                $courierDeliveryMethod = CourierDeliveryMethod::whereJsonContains('states', trim($state))->first();
            if (!$courierDeliveryMethod)
                $courierDeliveryMethod = CourierDeliveryMethod::whereJsonContains('countries', 'Россия')->first();

            if ($courierDeliveryMethod) {
                $order->update([
                    'service' => $courierDeliveryMethod->delivery_method_id,
                    'shipping_method' => $courierDeliveryMethod->prefix
                ]);
            }
        }
    }

    private function clearStreet(string $street): string
    {
        return Str::replace(
            [
                'улица'
            ],
            '',
            $street
        );
    }

}
