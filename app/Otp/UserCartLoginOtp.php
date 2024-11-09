<?php

namespace App\Otp;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use SadiqSalau\LaravelOtp\Contracts\OtpInterface as Otp;

class UserCartLoginOtp implements Otp
{
    protected string $redirectTo = '/cart/delivery';

    /**
     * Constructs Otp class
     */
    public function __construct(
        public array $data
    )
    {
        //
    }

    /**
     * Processes the Otp
     *
     * @return mixed
     */
    public function process()
    {
        $user = User::where('phone', $this->data['phone'])->first();

        if (!$user) {
            $user = User::create([
                'name' => $this->data['name'],
                'surname' => $this->data['surname'],
                'email' => $this->data['email'],
                'password' => Hash::make(Str::random()),
                'phone' => $this->data['phone'],
                'is_subscribed' => 1,
            ]);
            event(new Registered($user));
        }

        Auth::login($user, true);
        Session::regenerate();

        return [
            'user' => $user,
            'redirect_url' => url()->to($this->redirectTo)
        ];
    }
}
