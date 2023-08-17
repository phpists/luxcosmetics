<?php

namespace App\Http\Controllers;

use App\Models\ProductQuestion;
use App\Models\ProductQuestionMessage;
use App\Services\SiteService;
use Illuminate\Database\Query\JoinClause;
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
        return redirect()->back()->with('success', 'Спасибо, вопрос отправлен на модерацию');
    }

    public function loadQuestions(Request $request) {
        $questions = ProductQuestion::query()
            ->select(['product_questions.*', 'comments_actions.is_like as is_like'])
            ->leftJoin('comments_actions', function (JoinClause $join) use ($request) {
                $join
                    ->on('comments_actions.record_id', '=', 'product_questions.id')
                    ->where('comments_actions.client_ip', $request->ip())
                    ->where('comments_actions.table_name', 'product_questions');
            })
            ->where('product_id', $request->product_id)
            ->where('status', '>', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(ProductQuestion::ITEMS_PER_PAGE, ['*'], 'page', $request->page);
        $html = view('products.product_questions', compact('questions'))->render();
        return response()->json([
            'htmlBody' => $html,
            'hasMore' => $questions->hasMorePages()
        ]);
    }
}
