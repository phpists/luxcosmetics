<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GiftController extends Controller
{
    public function create() {
        return view('gift_cards.create');
    }

    public function show(Request $request, string $alias) {
        return view('gift_cards.gift-card');
    }
}
