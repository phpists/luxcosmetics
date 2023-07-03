<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeedbackReason;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class FeedbackReasonController extends Controller
{
    public function index() {
        $feedback_reasons = FeedbackReason::query()->paginate(30);
        return view('admin.feedback_reasons.index', compact('feedback_reasons'));
    }

    public function show(Request $request) {
        $reason = FeedbackReason::query()->find($request->id);
        if (!$reason) {
            return response()->json([
                'status' => false,
                'message' => 'Feedback reason with id '.$request->id.' not found'
            ], 404);
        }
        return response()->json($reason);
    }

    public function store(Request $request) {
        $reason = new FeedbackReason($request->all());
        $reason->save();
        return redirect()->back()->with('success', 'Причина обращения успешно добавлена');
    }

    public function update(Request $request) {
        $reason = FeedbackReason::query()->find($request->id);
        if (!$reason) {
            return response()->json([
                'status' => false,
                'message' => 'Feedback reason with id '.$request->id.' not found'
            ], 404);
        }
        $reason->update($request->all());
        return redirect()->back()->with('success', 'Причина обращения успешно обновлена');
    }

    public function delete(Request $request) {
        $reason = FeedbackReason::query()->find($request->id);
        if (!$reason) {
            return response()->json([
                'status' => false,
                'message' => 'Feedback reason with id '.$request->id.' not found'
            ], 404);
        }
        $reason->delete();
        return redirect()->back()->with('success', 'Причина обращения  успешно удалена');
    }
}
