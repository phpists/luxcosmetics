<?php

namespace App\Listeners;

use App\Events\OrderCompletedEvent;
use App\Models\LoyaltyStatus;

class LoyaltyStatusAssignmentListener
{
    public function __construct()
    {
    }

    public function handle(OrderCompletedEvent $event): void
    {
        $user = $event->order->user;
        $achievedStatusSum = $user->loyaltyStatus?->achieve_sum;

        // not VIP
        if (!is_null($achievedStatusSum)) {
            $allOrdersTotalSum = $user->orders()
                ->completed()
                ->sum('total_sum');

            $nextStatus = LoyaltyStatus::whereNotNull('achieve_sum')
                ->where('achieve_sum', '>', $achievedStatusSum)
                ->first();

            if ($nextStatus && $allOrdersTotalSum >= $nextStatus->achieve_sum)
                $user->update(['loyalty_status_id' => $nextStatus->id]);
        }
    }
}
