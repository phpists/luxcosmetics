<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeedbackChat;
use App\Models\FeedbackReason;
use App\Models\ProductImage;
use App\Services\SiteService;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(Request $request) {
        $chats = FeedbackChat::query();
        $status_filter = $request->query('status', null);
        if ($status_filter !== null) {
            $chats = $chats->where('status', $status_filter);
        }
        if ($request->feedbacks_reason_id) {

            $chats->where('feedback_theme', $request->feedbacks_reason_id);
        }

        $themes = FeedbackReason::query()->get();

        $chats = $chats->paginate(15);
        if ($request->ajax()) {
            $productsHtml = view('admin.chats.parts.table', ['chats' => $chats, 'themes' => $themes])->render();
            $paginateHtml = view('admin.chats.parts.pagination', ['chats' => $chats, 'params' => $request->all()])->render();

            return response()->json([
                'productsHtml' => $productsHtml,
                'paginateHtml' => $paginateHtml,
            ]);
        }
        return view('admin.chats.index', compact('chats', 'themes'));
    }

    public function edit(Request $request, $id) {
        $chat = FeedbackChat::query()->find($id);
        if ( $chat->status === FeedbackChat::NEW ) {
            $chat->update(['status' => 2]);
            $chat->save();
        }
        return view('admin.chats.chat', compact('chat'));
    }

    public function updateStatus(Request $request) {
        $chat_ids = $request->checkbox;
        FeedbackChat::query()->whereIn('id', $chat_ids)->update([
            'status' => $request->status
        ]);
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Статус успешно обновлен',
                'title' => SiteService::getChatStatus($request->status)
            ]);
        }
        else {
            return redirect()->route('admin.chats')->with('success', 'Статус тикета обновлен');
        }
    }
}
