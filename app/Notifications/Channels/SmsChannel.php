<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;

class SmsChannel
{
    /**
     * Send the given notification.
     */
    public function send(object $notifiable, Notification $notification): void
    {
        $message = $notification->toSms($notifiable);
        $phone = $notifiable->routeNotificationFor(self::class);
        $message->to($phone);

        if (config('app.env') == 'production')
            $message->send();

        if (config('app.env') == 'staging' && !$this->isMockPhone($phone))
            $message->send();
    }

    private function isMockPhone(string $phone): bool
    {
        $phone = preg_replace('/\D/', '', $phone);
        $mockPhone = env('SMS_MOCK_PHONE');

        return $phone == $mockPhone;
    }
}
