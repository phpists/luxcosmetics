<?php

namespace App\Http\Controllers;

use App\Mail\GiftCardEmail;
use App\Models\GiftCard;
use App\Models\GiftCardValue;
use App\Models\PaymentCard;
use App\Services\GiftCardService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

    public function cartStore(Request $request, GiftCardService $giftCardService)
    {
        if (!session()->has(self::SESSION_KEY))
            return redirect()->route('gif-card.index');

        $card_id = $request->post('card_id');

        if (!$card_id) {
            $card_data = $request->post('card');
            $card_data['card_number'] = trim($card_data['card_number']);
            $card_data['valid_date'] = $card_data['month'].'/'.$card_data['year'];
            $card_data['cvv'] = Hash::make($card_data['cvv']);
            $card_data['is_default'] = $request->boolean('cart.is_default');
            $card_data['user_id'] = Auth::id();
            $card = PaymentCard::create($card_data);
            $card_id = $card->id;
        }

        $data = (array) session()->get(self::SESSION_KEY);
        $data['card_id'] = $card_id;

        if ($giftCardService->store($data)) {
            session()->forget(self::SESSION_KEY);
            session()->put('gift_card_success_data', $data);
            return redirect()->route('gift-card.cart.success')
                ->with('success', 'Подарочная карта отправлена на указанную почту');
        } else {
            return back();
        }
    }

    public function success()
    {
        $data = session()->get('gift_card_success_data');
        session()->forget('gift_card_success_data');
        return view('gift_cards.success', compact('data'));
    }




    private function generateCode() {
        $number = mt_rand(1000000000000000, 9999999999999999);

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
            DB::commit();

            return back()->with('success', 'На ваш баланс начислена сумма - ' . $gift_card->sum);
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'ОШИБКА: ' . $exception->getMessage());
        }
    }



}
