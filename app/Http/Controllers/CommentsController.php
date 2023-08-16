<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\CommentsAction;
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
        $user = Auth::user();
        $commentId = $request->input('comment_id');

        $comment = Comments::findOrFail($commentId);

        $existingAction = CommentsAction::where('user_id', $user->id)
            ->where('report_id', $comment->id)
            ->first();

        if (!$existingAction) {
            $commentAction = new CommentsAction();
            $commentAction->user_id = $user->id;
            $commentAction->has_like = $request->input('like');
            $commentAction->report_id = $comment->id;
            $commentAction->save();

            $likesCount = CommentsAction::where('like', true)
                ->where('report_id', $comment->id)
                ->count();


            $comment->like = $likesCount;
            $comment->save();
        }
        return response()->json(['success' => true]);
    }
}
