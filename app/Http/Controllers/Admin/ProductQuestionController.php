<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeedbackChat;
use App\Models\ProductQuestion;
use App\Models\ProductQuestionMessage;
use Illuminate\Http\Request;
use Symfony\Component\Console\Question\Question;

class ProductQuestionController extends Controller
{
    public function answer(Request $request){
        $data = $request->all();
        $user = $request->user();
        $data['user_id'] = $user->id;
        $data['username'] = $user->name.' '.$user->surname;
        $data['email'] = $user->email;
        $product_message = new ProductQuestionMessage($data);
        $product_message->save();
        $product_question = ProductQuestion::query()->find($data['question_id']);
        $product_question->update(['status' => FeedbackChat::CLOSED]);
        return redirect()->back();
    }

    public function index(){
        $questions = ProductQuestion::query()->with('messages')->paginate(20);
        return view('admin.product_questions.index', compact('questions'));
    }

    public function edit(Request $request, $id){
        $question = ProductQuestion::query()->findOrFail($id);
        if ($question->status === FeedbackChat::NEW)
            $question->status = 2;
        $question->save();
        return view('admin.product_questions.question', compact('question'));
    }
}
