<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\PaymentCard;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(Request $request) {
        return view('cabinet.index', [
            'user' => $request->user()
        ]);
    }

    public function edit(Request $request) {
        return view('cabinet.edit', [
            'user' => $request->user()
        ]);
    }

    public function update(Request $request) {
        $data = $request->all();
        $date = date_create_from_format('Y-m-d', $data['year'].'-'.$data['month'].'-'.$data['day']);
        if ($date)
            $data['birthday'] = $date;
        $data['is_subscribed'] = $request->is_subscribed !== null?1:0;
        if ($request->password !== null)
            $data['password'] = Hash::make($data['password']);
        else
            unset($data['password']);

        User::query()->find($request->user()->id)->update($data);

        return redirect()->route('profile');
    }

    public function order_history() {
        return view('cabinet.myorders');
    }

    public function subscriptions(Request $request) {
        return view('cabinet.index', [
            'user' => $request->user()
        ]);
    }
    public function addresses(Request $request) {
        return view('cabinet.myaddresses', [
            'user' => $request->user()
        ]);
    }

    public function update_default_address(Request $request) {
        Address::query()->where('is_default', 1)->update(['is_default' => 0]);
        $address = Address::query()->find($request->id);
        if(!$address) {
            return response()->json(['status' => false, 'id' => $request->all()]);
        }
        $address->update(['is_default' => 1]);
        return response()->json(['status' => true]);
    }

    public function add_address(Request $request) {
        $data = $request->all();
        $data['is_default'] = $request->is_default !== null? 1: 0;
        $addresses = Address::query()->where('is_default', '1');
        $default_count = $addresses->count();
        if($default_count > 0 && $data['is_default']) {
            $addresses->update([
                'is_default' => 0
            ]);
        }
        elseif ($default_count === 0 && !$data['is_default']) {
            $data['is_default'] = 1;
        }
        $data['user_id'] = $request->user()->id;
        $address = new Address($data);
        $address->save();
        return redirect()->back();
    }

    public function payment_methods(Request $request) {
        $payment_cards = DB::table('payment_cards')->where('user_id', $request->user()->id)->get();
        return view('cabinet.paymethods', compact('payment_cards'));
    }

    public function add_payment(Request $request) {
        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        $data['card_number'] = trim($data['card_number']);
        $data['valid_date'] = $data['month'].'/'.$data['year'];
        $data['cvv'] = Hash::make($data['cvv']);
        $data['is_default'] = $request->is_default !== null? 1: 0;
        $payment_cards = PaymentCard::query()->where('is_default', '1');
        $default_count = $payment_cards->count();
        if($default_count > 0 && $data['is_default']) {
            $payment_cards->update([
                'is_default' => 0
            ]);
        }
        elseif ($default_count === 0 && !$data['is_default']) {
            $data['is_default'] = 1;
        }
        $payment_card = new PaymentCard($data);
        $payment_card->save();
        return redirect()->back();
    }

    public function gift_cards() {
        return view('cabinet.giftcard');
    }

    public function bonuses(Request $request) {
        return view('cabinet.points', [
            'user' => $request->user
        ]);
    }

    public function password(Request $request) {
        return view('cabinet.password', [
            'user' => $request->user()
        ]);
    }

    public function reset_password(Request $request): RedirectResponse
    {
//        dd([$request->user()->password, Hash::make($request->original_password), $request->original_password]);
        $is_valid_old = Hash::check($request->original_password, $request->user()->password);
        $is_submitted_new = $request->new_password === $request->new_confirm;
        if ($is_valid_old && $is_submitted_new) {
            User::query()->find($request->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            return redirect()->route('profile');
        }
        else {
            $messages = [];
            if(!$is_valid_old)
                $messages[]='Неправильный старый пароль';
            if(!$is_submitted_new)
                $messages[]='Новый пароль не совпадает со старым';
            return redirect()->back()->with('errors', $messages);
        }
    }

<<<<<<< HEAD
    public function support(Request $request) {
        return view('cabinet.support', [
            'user' => $request->user
        ]);
=======
    public function logout() {
        Auth::logout();
        return redirect()->route('home');
>>>>>>> b006592f8d75532e437315e089ac05a1794d8a18
    }

//    public function logout() {
//        return view('cabinet.support');
//    }
}
