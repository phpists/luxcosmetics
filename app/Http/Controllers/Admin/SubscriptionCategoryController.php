<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionCategory;
use Illuminate\Http\Request;

class SubscriptionCategoryController extends Controller
{
    public function index() {
        $this->authorize('viewAny', SubscriptionCategory::class);

        $subscription_categories = SubscriptionCategory::query()->paginate(30);
        return view('admin.subscriptions.categories', compact('subscription_categories'));
    }

    public function store(Request $request) {
        $this->authorize('create', SubscriptionCategory::class);

        (new SubscriptionCategory($request->all()))->save();
        return redirect()->back()->with('success', 'Категория успешно создана');
    }

    public function update(Request $request) {
        $this->authorize('update', SubscriptionCategory::class);

        $subscription = SubscriptionCategory::query()->find($request->id);
        if (!$subscription) {
            return redirect()->back()->with('error', 'Категория не найдена');

        }
        try {
            $subscription->update($request->all());
            return redirect()->back()->with('success', 'Категория успешно обновлена');
        }
        catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Ошибка при обновлении категории');
        }
    }

    public function show(Request $request) {
        $this->authorize('view', SubscriptionCategory::class);

        $subscription = SubscriptionCategory::query()->find($request->id);
        if (!$subscription) {
            return response()->json([
                'status' => true,
                'message' => 'Record not found'
            ], 404);
        }
        return response()->json($subscription);
    }

    public function delete(Request $request) {
        $this->authorize('delete', SubscriptionCategory::class);

        $subscription = SubscriptionCategory::query()->find($request->id);
        if($subscription) {
            $subscription->delete();
        }
        else {
            return redirect()->back()->with('error', 'Запись не найдена');
        }
        return redirect()->back()->with('success', 'Запись успешно удалена');

    }
}
