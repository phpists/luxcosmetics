<?php

namespace App\Http\Controllers;

use App\Models\FeedbackChat;
use App\Models\FeedbackMessage;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{
    public function store(Request $request) {
        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        $data['status'] = 1;
        $feedback_chat = new FeedbackChat($data);
        $feedback_chat->save();
        $data['user_id'] = $request->user()->id;
        $data['chat_id'] = $feedback_chat->id;
        $message = new FeedbackMessage($data);
        if(!$message->save()) {
            return redirect()->back()->with('error', 'Не удалось создать сообщение');
        }
        return redirect()->back()->with('success', 'Тикет успешно создан');
    }

    public function update(Request $request, $id) {
        $data = $request->only([
            'assignee_id' => 'exists:users,id',
            'status' => 'string'
        ]);
        DB::table('feedback_chats')->where('id', $id)->update($data);
    }

    public function store_message(Request $request) {
        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        $message = new FeedbackMessage($data);
        $is_saved = $message->save();
        if ($request->ajax()) {
            if ($is_saved) {
                return response()->json([
                    'status' => true
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'couldn`t save message'
                ]);
            }
        }
        else {
            if ($is_saved) {
                return redirect()->back()->with('success', 'Успешно отправлено');
            } else {
                return redirect()->back()->with('error', 'Не удалось отправить сообщение');
            }
        }
    }
}
