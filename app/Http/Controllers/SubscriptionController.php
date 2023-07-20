<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request) {
        $subscriber = Subscriber::query()->where('email' , $request->email)->first();
        if (!$subscriber) {
            Subscriber::query()->insert([
                'email' => $request->email
            ]);
        }
        return redirect()->back();
    }
}
