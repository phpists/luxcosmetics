<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\FastRegistrationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class FastRegisterController extends Controller
{

    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'unique:users'],
        ]);
        $email = $data['email'];
        $newsletter = $request->boolean('newsletter');
        $password = Str::random(8);

        $user = User::create([
            'name' => explode('@', $email)[0] ?? '',
            'email' => $data['email'],
            'password' => Hash::make($password),
            'is_subscribed' => $newsletter,
        ]);

        Auth::login($user);
        Mail::to($email)->send(new FastRegistrationMail($email, $password));

        return redirect()->route('cart.delivery');
    }

}
