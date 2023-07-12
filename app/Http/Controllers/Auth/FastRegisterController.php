<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

        $user = User::create([
            'name' => explode('@', $email)[0] ?? '',
            'email' => $data['email'],
            'password' => Hash::make(Str::random(8)),
            'is_subscribed' => $newsletter,
        ]);

        Auth::login($user);

        return redirect()->route('cart.delivery');
    }

}
