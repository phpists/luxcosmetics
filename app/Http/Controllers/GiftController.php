<?php

namespace App\Http\Controllers;

use App\Models\GiftCard;
use App\Models\GiftCardValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GiftController extends Controller
{
    public function index()
    {
        return view('gift_cards.gift-card');
    }

    public function create()
    {
        $items = GiftCardValue::all();
        return view('gift_cards.create', compact('items'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'receiver_email_confirm' => 'required|email|same:receiver_email',
        ], [
            'same' => 'Поле email не совпадет',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $items = $request->all();
        $gift = new GiftCard($items);
        $gift->save();
        return redirect()->route('cart');
    }
}
