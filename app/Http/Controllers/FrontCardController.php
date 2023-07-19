<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontCardController extends Controller
{
    const ITEMS = [
        'cart-error' => 'cart.cart-error',
        'cart-step-3' => 'cart.cart-step-3',
        'cart-success' => 'cart.cart-success',
        'cart-updated' => 'cart.cart-updated'
    ];

    public function index() {
        return view('front-pages', [
            'items' => self::ITEMS
        ]);
    }

    static public function link_generate($alis) {
        return url('/front/'.$alis);
    }


    public function page($alis) {
        return view(self::ITEMS[$alis]);
    }
}
