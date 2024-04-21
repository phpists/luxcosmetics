<?php

namespace App\Console\Commands;

use App\Models\DeliveryMethod;
use App\Models\DeliveryPoint;
use Illuminate\Console\Command;

class SyncDeliveryMethodsCommand extends Command
{
    protected $signature = 'delivery:sync';

    protected $description = 'Getting all delivery methods provided in FM API data and syncing it with our DB';

    public function handle(): void
    {
        $deliveryMethodNames = DeliveryPoint::groupBy('lms')->pluck('lms')->toArray();
        foreach ($deliveryMethodNames as $deliveryMethodName) {
            DeliveryMethod::firstOrCreate([
                'name' => $deliveryMethodName
            ], [
                'name' => $deliveryMethodName,
                'title' => $deliveryMethodName,
                'is_active' => 0,
                'pos' => DeliveryMethod::max('pos') + 1,
            ]);
        }
    }
}
