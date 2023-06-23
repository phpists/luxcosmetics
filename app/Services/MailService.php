<?php


namespace App\Services;


use App\Mail\RegistrationConfirmation;
use Illuminate\Mail\SentMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MailService
{
    /**
     * Збереження зображень
     * @param $user
     * @return SentMessage
     */
    public static function sendRegistrationMessage($user): SentMessage
    {
        return Mail::to($user->email)->send(new RegistrationConfirmation($user));
    }
}

