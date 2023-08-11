<?php

namespace App\Http\Controllers;

use App\Mail\GiftCardEmail;
use App\Models\GiftCard;
use App\Models\GiftCardValue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class GiftController extends Controller
{

    private const SESSION_KEY = 'gift_cards';


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

        session()->forget(self::SESSION_KEY);
        session()->put(self::SESSION_KEY, (object)$items);

//        $gift = new GiftCard($items);
//        $gift->save();

        return redirect()->route('gift_card.cart');
    }

    public function cart()
    {
        $giftCard = session()->get(self::SESSION_KEY);

        return view('gift_cards.cart', compact('giftCard'));
    }

    public function cartClear()
    {
        session()->forget(self::SESSION_KEY);
        return redirect()->route('gift_card.create');
    }

    public function cartStore(Request $request)
    {
        if (!session()->has(self::SESSION_KEY))
            return redirect()->route('gift_card.create');

        $data = (array) session()->get(self::SESSION_KEY);
        $data['code'] = $this->generateCode();
        $gift = new GiftCard($data);
        $gift->save();

        Mail::to($gift->receiver_email)->send(new GiftCardEmail($gift));

        return redirect()->route('profile.gift-cards')->with('success', 'Подарочная карта отправлена на указанную почту');
    }




    private function generateCode() {
        $number = mt_rand(100000000000, 999999999999);

        if ($this->codeExists($number))
            return $this->generateCode();

        return $number;
    }

    private function codeExists($code) {
        return GiftCard::where('code', $code)->exists();
    }





    public function activate(Request $request)
    {
        $code = $request->post('code');
        $gift_card = GiftCard::where('code', $code)->first();

        if (!$gift_card)
            return back()->with('error', 'Такой подарочной карты не существует');
        if ($gift_card->isActivated())
            return back()->with('error', 'Подарочная карта уже была активирована');

        $user = Auth::user();

        try {
            DB::beginTransaction();
            $gift_card->update([
                'activated_by' => $user->id,
                'activated_at' => Carbon::now()
            ]);
            $user->increment('gift_card_balance', $gift_card->sum);
            DB::commit();

            return back()->with('success', 'На ваш баланс начислена сумма - ' . $gift_card->sum);
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'ОШИБКА: ' . $exception->getMessage());
        }
    }



}
