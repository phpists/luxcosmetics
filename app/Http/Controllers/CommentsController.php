<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\CommentsAction;
use App\Models\ProductQuestion;
use App\Models\ProductQuestionMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        Log::info($request->all());
        $data = $request->all();
        if (Auth::check()) {
            $name = auth()->user()->name;
            $email = auth()->user()->email;

            $data['name'] = $name;
            $data['email'] = $email;
        }
        Comments::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'rating' => $data['rating'],
            'description' => $data['description'],
            'product_id' => $data['product_id']
        ]);

        return redirect()->back()->with('success', 'Спасибо, комментарий отправлен на модерацию');
    }
    public function like(Request $request)
    {
        $recordId = $request->input('record_id');

        if ($request->table_name === 'product_questions') {
            $record = ProductQuestion::query()->find($recordId);
        }
        else {
            $record = Comments::query()->find($recordId);
        }

        $existingAction = CommentsAction::where('client_ip', $request->ip())
            ->where('record_id', $recordId)
            ->first();
        $count = 0;
        if (!$existingAction) {
            $data = [
                'is_like' => $request->input('isLiked'),
                'record_id' => $recordId,
                'table_name' => $request->table_name,
                'client_ip' => $request->ip()
            ];
            $commentAction = new CommentsAction($data);
//            $commentAction->client_ip = $request->ip();
//            $commentAction->is_like = $request->input('isLiked');
//            $commentAction->record_id = $recordId;
//            $commentAction->table_name = $request->table_name;
            $commentAction->save();
            if ((bool)$request->isLiked) {
                $record->like = $record->like + 1;
                $count = $record->like;
            }
            else {
                $record->dislike = $record->dislike + 1;
                $count = $record->dislike;
            }
            $record->save();
        }
        elseif ((bool)$existingAction->is_like === (bool)$request->isLiked) {
            $existingAction->delete();
            if ((bool)$request->isLiked) {
                $record->like = $record->like - 1;
                $count = $record->like;
            }
            else {
                $record->dislike = $record->dislike - 1;
                $count = $record->dislike;
            }
            $record->save();
        }
        else {
            $existingAction->update([
                'is_like'=> $request->isLiked
            ]);
            if ((bool)$request->isLiked) {
                $record->like = $record->like + 1;
                $record->dislike = $record->dislike - 1;
                $count = $record->like;
            }
            else {
                $record->dislike = $record->dislike + 1;
                $record->like = $record->like - 1;
                $count = $record->dislike;
            }
            $record->save();
        }
        return response()->json(['like' => $record->like, 'dislike' => $record->dislike]);
    }
}
