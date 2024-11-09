<?php

namespace App\Providers;

use App\Events\OrderCancelled;
use App\Events\OrderCreated;
use App\Events\ProductBecameAvailableEvent;
use App\Listeners\MakeRefundOrder;
use App\Listeners\MigrateFavouriteProducts;
use App\Listeners\NotifyProductWaitersListener;
use App\Listeners\Order\FillAdditionalFields;
use App\Listeners\SendWelcomeEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendWelcomeEmail::class,
            MigrateFavouriteProducts::class,
        ],
        OrderCreated::class => [
            FillAdditionalFields::class
        ],
        OrderCancelled::class => [
            MakeRefundOrder::class
        ],
        ProductBecameAvailableEvent::class => [
            NotifyProductWaitersListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
