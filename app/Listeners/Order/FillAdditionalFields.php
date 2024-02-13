<?php

namespace App\Listeners\Order;

use App\Events\OrderCreated;
use App\Models\DeliveryPoint;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Style\Fill;

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
        dispatch(new \App\Jobs\Order\FillAdditionalFields($event->order));
    }
}
