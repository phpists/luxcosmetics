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

        if (!is_null($achievedStatusSum)) {
            $allOrdersTotalSum = $user->orders()
                ->completed()
                ->sum('total_sum');

            $total = intval($achievedStatusSum + $allOrdersTotalSum);

            if ($total > $achievedStatusSum) {
                $nextStatus = LoyaltyStatus::whereNotNull('achieve_sum')
                    ->where('achieve_sum', '<=', $total)
                    ->orderByDesc('discount_percent')
                    ->first();

                if ($nextStatus) {
                    $user->update(['loyalty_status_id' => $nextStatus->id]);
                }
            }
        }
    }

}
