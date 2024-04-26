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
            $shippingMethod = $order->deliveryMethod?->shipping_method
                ?? $order->deliveryPoint->lms . '_' . $order->delivery_type;

            $address = explode(',', $order->city);
            $street = $address[2] ?? null;

            $order->update([
                'zip' => $order->deliveryPoint->zipCode,
                'delivery_point_id' => $order->deliveryPoint->pointId,
                'delivery_point_code' => $order->deliveryPoint->pointCode,
                'shipping_method' => $shippingMethod,
                'city' => $order->deliveryPoint->cityName,
                'street' => $street,
                'house' => $order->deliveryPoint->pointId,
            ]);
        } elseif ($order->delivery_type == Order::DELIVERY_COURIER) {
            if (str_contains($order->city, 'обл')) {
                $addressParts = explode(',', $order->city);
                $state = null;
                $city = $addressParts[0];
                foreach ($addressParts as $addressPart) {
                    if (str_contains($addressPart, 'обл'))
                        $state = $addressPart;
                }
            } else {
                $city = $order->city;
            }

            $courierDeliveryMethod = CourierDeliveryMethod::whereJsonContains('cities', trim($city))->first();
            if (!$courierDeliveryMethod && isset($state))
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
        return trim(Str::replace(
            [
                'улица',
                'ул.'
            ],
            '',
            $street
        ));
    }

}
