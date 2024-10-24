<?php

namespace App\Otp;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use SadiqSalau\LaravelOtp\Contracts\OtpInterface as Otp;

class UserRegisterOtp implements Otp
{
    /**
     * Constructs Otp class
     */
    public function __construct(
        public array $data,
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
        $birthday = null;
        if (isset($this->data['birthday']['year']) && isset($this->data['birthday']['month']) && isset($this->data['birthday']['day']))
            $birthday = Carbon::parse($this->data['birthday']['year'] . '-' . $this->data['birthday']['month'] . '-' . $this->data['birthday']['day']);

        $user = User::create([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'password' => Hash::make(Str::random()),
            'surname' => $this->data['surname'] ?? null,
            'phone' => $this->data['phone'],
            'is_subscribed' => $this->data['newsletter'] ?? 0,
            'birthday' => $birthday,
        ]);

        event(new Registered($user));

        Auth::login($user, true);
        Session::regenerate();

        return [
            'user' => $user
        ];
    }
}
