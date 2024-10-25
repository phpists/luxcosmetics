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
        $message->to($notifiable->routeNotificationFor(self::class));
        $message->send();
    }
}
