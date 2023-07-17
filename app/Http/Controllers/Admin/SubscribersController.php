<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewsLetter;
use App\Mail\RegistrationConfirmation;
use App\Models\SubscriptionCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SubscribersController extends Controller
{
    public function index(Request $request) {
        $subscribers = User::query()->where('is_subscribed', true)->paginate(30);
        $subscription_categories = SubscriptionCategory::query()->get();
        return view('admin.subscriptions.subscribers', compact('subscribers', 'subscription_categories'));
    }

    public function delete($id) {
        User::query()->where('id', $id)->update([
            'is_subscribed' => false
        ]);
        return redirect()->back()->with('success', 'Подписчик успешно удален');
    }

    public function send_newsletter(Request $request){
        $users = User::query();
        if (!is_null($request->category_id) && $request->category_id != -1) {
            $users = $users
                ->where('subscription_category_id', $request->category_id);
        }
        $users = $users->get();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new NewsLetter($request->subject, $request->message));
        }
        return redirect()->back()->with('success', 'Рассылка успешно отправлена');
    }
}
