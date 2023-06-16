<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeedbackChat;
use App\Services\SiteService;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(Request $request) {
        $chats = FeedbackChat::query()->get();
        return view('admin.chats.index', compact('chats'));
    }

    public function edit(Request $request, $id) {
        $chat = FeedbackChat::query()->find($id);
        $chat->update(['status' => 2]);
        $chat->save();
        return view('admin.chats.chat', compact('chat'));
    }

    public function updateStatus(Request $request) {
        $chat_ids = $request->checkbox;
        $chat = FeedbackChat::query()->whereIn('id', $chat_ids)->update([
            'status' => $request->status
        ]);
        return response()->json([
           'message' => 'Статус успешно обновлен',
            'title' => SiteService::getChatStatus($request->status)
        ]);
    }
}
