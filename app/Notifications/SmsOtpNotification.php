<?php

namespace App\Notifications;

use App\Notifications\Channels\SmsChannel;
use App\Notifications\Messages\SmsMessage;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use SadiqSalau\LaravelOtp\OtpNotification;

class SmsOtpNotification extends OtpNotification implements ShouldQueue
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [SmsChannel::class];
    }

    /**
     * Get the sms message representation of the notification.
     */
    public function toSms(object $notifiable): SmsMessage
    {
        $expiresAt = Carbon::parse($this->data['expires'])->format('H:i');

        return (new SmsMessage)
            ->line('Ваш код для авторизации: ' . $this->data['code'])
            ->line('Код действителен до ' . $expiresAt);
    }
}
