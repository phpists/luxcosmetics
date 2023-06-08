<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index() {
        return view('cabinet.index');
    }

    public function edit() {
        return view('cabinet.edit');
    }

    public function order_history() {
        return view('cabinet.myorders');
    }

    public function subscriptions() {
        return view('cabinet.index');
    }
    public function addresses() {
        return view('cabinet.myaddresses');
    }

    public function payment_methods() {
        return view('cabinet.paymethods');
    }

    public function gift_cards() {
        return view('cabinet.giftcard');
    }

    public function bonuses() {
        return view('cabinet.points');
    }

    public function password() {
        return view('cabinet.password');
    }

    public function support() {
        return view('cabinet.support');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('home');
    }
}
