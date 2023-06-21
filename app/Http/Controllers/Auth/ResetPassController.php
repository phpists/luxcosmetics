<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResetPassController extends Controller
{
    public function reset(Request $request) {
        $user = User::query()->where('email', $request->input('email'))->first();

        if ($user) {
            $password = Str::password(length: 6);
            $user->update([
                'password' => Hash::make($password)
            ]);
            $user->save();
            Mail::to($user->email)->send(new ResetPassword($password, $user->name));
            return view('auth.reset-verify', [
                'email' => $user->email
            ]);
        }
        else {
            return redirect()->back()->with('error', 'Пользователь с данной почтой не сушествует');
        }

    }
}
