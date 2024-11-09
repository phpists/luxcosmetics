<?php

namespace App\Listeners;

use App\Services\FavoriteProductsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MigrateFavouriteProducts implements ShouldQueue
{
    /**
     * Create the event listener. favorite favourite
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        FavoriteProductsService::migrateIntoDb($event->user->id);
    }
}
