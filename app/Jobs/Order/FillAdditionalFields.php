<?php

namespace App\Jobs\Order;

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
            if ($order->service == Order::DELIVERY_SERVICE_CDEK) {
                $deliveryPoint = DeliveryPoint::whereLms('cdek')
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
                    ]);
                }
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
