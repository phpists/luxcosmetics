<?php

namespace App\Listeners\Order;

use App\Events\OrderCreated;
use App\Models\DeliveryPoint;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

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
        \App\Jobs\Order\FillAdditionalFields::dispatch($event->order);
    }
}
