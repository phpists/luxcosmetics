<?php

namespace App\Listeners;


use App\Events\ProductBecameAvailableEvent;
use App\Mail\ProductBecameAvailableMail;
use App\Models\ProductAvailabilityWaiter;

class NotifyProductWaitersListener
{
    public function __construct()
    {
    }

    public function handle(ProductBecameAvailableEvent $event): void
    {
        $productWaiters = ProductAvailabilityWaiter::whereProductId($event->product->id)->get();

        foreach ($productWaiters as $productWaiter) {
            \Mail::to($productWaiter->email)->send(new ProductBecameAvailableMail($productWaiter->name, $productWaiter->product));
            $productWaiter->delete();
        }
    }

}
