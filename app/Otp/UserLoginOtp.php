<?php

namespace App\Otp;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use SadiqSalau\LaravelOtp\Contracts\OtpInterface;

class UserLoginOtp implements OtpInterface
{
    public string $redirectTo = RouteServiceProvider::HOME;

    /**
     * Constructs Otp class
     */
    public function __construct(
        public string $phone
    )
    {
        //
    }

    /**
     * Processes the Otp
     *
     * @return array
     */
    public function process(): array
    {
        $user = User::where('phone', $this->phone)->first();

        Auth::login($user, true);
        Session::regenerate();

        return [
            'user' => $user,
            'redirect_url' => $this->redirectTo
        ];
    }
}
