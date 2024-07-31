<?php

namespace App\Http\Controllers;

use App\Mail\TicketAnsweredMail;
use App\Mail\TicketCreatedMail;
use App\Models\FeedbackChat;
use App\Models\FeedbackMessage;
use App\Models\FeedbackMessageFile;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FeedbackController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'files.*' => ['nullable', 'file', 'max:' . 1 * 1024 * 1024]
        ]);

        DB::beginTransaction();

        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        $data['status'] = 1;
        $feedback_chat = new FeedbackChat($data);
        $feedback_chat->save();
        $data['user_id'] = $request->user()->id;
        $data['chat_id'] = $feedback_chat->id;
        $message = new FeedbackMessage($data);

        if(!$message->save()) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Не удалось создать сообщение');
        }

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                try {
                    $filePath = Storage::disk('google')->put(FeedbackMessageFile::FILES_PATH . $message->id, $file);
                    $message->files()->create([
                        'disk' => 'google',
                        'name' => $file->hashName(),
                        'path' => $filePath,
                    ]);
                } catch (\Exception $exception) {
                    \Log::error($exception->getMessage());
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Не удалось создать сообщение');
                }
            }
        }

        \Mail::to($request->user()->email)->send(new TicketCreatedMail($feedback_chat));

        DB::commit();

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

        $chat = FeedbackChat::find($data['chat_id']);

        $data['user_id'] = $request->user()->id;
        $message = new FeedbackMessage($data);
        $is_saved = $message->save();
        if ($request->ajax()) {
            if ($is_saved) {
                \Mail::to($chat->user->email)->send(new TicketAnsweredMail($chat));
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
                \Mail::to($chat->user->email)->send(new TicketAnsweredMail($chat));
                return redirect()->back()->with('success', 'Успешно отправлено');
            } else {
                return redirect()->back()->with('error', 'Не удалось отправить сообщение');
            }
        }
    }
}
