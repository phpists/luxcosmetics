<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        return view('cart.cart');
    }

    public function step_first() {
        return view('cart.pay-step1');
    }

    public function step_second() {
        return view('cart.pay-step2');
    }
}
