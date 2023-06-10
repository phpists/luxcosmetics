<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeedbackChat;
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
}
