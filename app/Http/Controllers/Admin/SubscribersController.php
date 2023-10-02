<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewsLetter;
use App\Models\Subscriber;
use App\Models\SubscriptionCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscribersController extends Controller
{
    public function index(Request $request) {
        $this->authorize('viewAny', Subscriber::class);

        $subscribers = Subscriber::query();
        if ($request->email) {
            $subscribers->where('email', 'LIKE', '%'.$request->email.'%');
        }
        $subscribers = $subscribers->paginate(30);
        $subscription_categories = SubscriptionCategory::query()->get();
        if ($request->ajax()) {
            $tableHtml = view('admin.subscriptions.parts.subscribers_table', ['subscribers' => $subscribers, 'subscription_categories' => $subscription_categories])->render();
            $paginationHtml = view('admin.subscriptions.parts.subscribers_pagination', ['subscribers' => $subscribers])->render();
            return response()->json([
                'tableHtml' => $tableHtml,
                'paginationHtml' => $paginationHtml
            ]);
        }
        return view('admin.subscriptions.subscribers', compact('subscribers', 'subscription_categories'));
    }

    public function delete($id) {
        $this->authorize('delete', Subscriber::class);

        Subscriber::query()->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Подписчик успешно удален');
    }

    public function send_newsletter(Request $request){
        $this->authorize('update', Subscriber::class);

        $subscribers = Subscriber::query();
        if (!is_null($request->category_id) && $request->category_id != -1) {
            $subscribers = $subscribers
                ->where('subscription_category_id', $request->category_id);
        }
        $subscribers = $subscribers->get();
        foreach ($subscribers as $user) {
            Mail::to($user->email)->send(new NewsLetter($request->subject, $request->message));
        }
        return redirect()->back()->with('success', 'Рассылка успешно отправлена');
    }

    public function update_category(Request $request) {
        $this->authorize('update', Subscriber::class);

        $checkbox_ids = $request->checkbox;
        foreach ($checkbox_ids as $id) {
            $subscriber = Subscriber::query()->find($id);
            if ($subscriber) {
                $subscriber->update([
                   'subscription_category_id' => $request->category_id
                ]);
            }
        }
        return response()->json(['status' => true]);
    }
}
