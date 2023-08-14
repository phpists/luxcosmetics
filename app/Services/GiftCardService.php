<?php

namespace App\Services;

use App\Mail\GiftCardEmail;
use App\Models\GiftCard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class GiftCardService
{

    public function store($data)
    {
        $data['code'] = $this->generateCode();
        $data['buyer_id'] = Auth::id();

        try {
            $gift = new GiftCard($data);
            $gift->save();
            Mail::to($gift->receiver_email)->send(new GiftCardEmail($gift));

            return true;
        } catch (\Exception $exception) {
            Session::flash('error', 'ОШИБКА: ' . $exception->getMessage());
            return false;
        }
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

}
