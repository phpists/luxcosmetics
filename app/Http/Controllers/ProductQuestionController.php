<?php

namespace App\Http\Controllers;

use App\Models\ProductQuestion;
use App\Models\ProductQuestionMessage;
use App\Services\SiteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductQuestionController extends Controller
{
    public function createQuestion(Request $request) {
        $data = $request->all();
        $data['status'] = 1;
        $question = new ProductQuestion($data);
        $question->save();
        $data['question_id'] = $question->id;
        if (Auth::check()){
            $data['user_id'] = $request->user()->id;
        }
        $message = new ProductQuestionMessage($data);
        $message->save();
        return redirect()->back();
    }
}
