<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID', '811922147593-kdpf4pumpbi7djhp2jvhhrba2mtmgi7d.apps.googleusercontent.com'),
        'client_secret' => env('GOOGLE_SECRET', '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'),
        'redirect' => env('GOOGLE_REDIRECT', 'http://localhost:8000/login/google/callback'),
        'captcha' => [
            'site_key' => env('GOOGLE_CAPTCHA_SITE_KEY'),
        ]
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID', '581638194042157'),
        'client_secret' => env('FACEBOOK_SECRET', '86b91a84e4695e7732fccb49a726534b'),
        'redirect' => env('FACEBOOK_REDIRECT', 'http://localhost:8000/login/facebook/callback')
    ],

    'sms_aero' => [
        'base_url' => env('SMS_AERO_BASE_URL', 'https://gate.smsaero.ru/v2'),
        'login' => env('SMS_AERO_LOGIN'),
        'api_key' => env('SMS_AERO_API_KEY'),
    ],

];
