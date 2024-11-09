<?php

namespace App\Services\Auth;

use App\Notifications\Channels\SmsChannel;
use Illuminate\Support\Facades\Notification;
use SadiqSalau\LaravelOtp\Contracts\OtpInterface;
use SadiqSalau\LaravelOtp\Facades\Otp;

class OtpService
{
    public function send(OtpInterface $handler, string $phone): array
    {
        // check valid code existence to avoid extra sending
        $checkOtp = Otp::identifier($phone)->check('111111');
        if ($checkOtp['status'] != Otp::OTP_EMPTY) {
            return [
                'status' => Otp::OTP_SENT
            ];
        }

        $notifiable = Notification::route(SmsChannel::class, $phone);

        $otp = Otp::identifier($phone)->send($handler, $notifiable);

        return [
            'status' => $otp['status'],
            'message' => __($otp['status'])
        ];
    }
}
