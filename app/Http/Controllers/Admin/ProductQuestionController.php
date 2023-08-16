<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeedbackChat;
use App\Models\Product;
use App\Models\ProductQuestion;
use App\Models\ProductQuestionMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        $product_question->update(['status' => ProductQuestion::CLOSED]);
        return redirect()->back()->with('success', 'Ответ отправлен');
    }

    public function index(Request $request){
        $questions = ProductQuestion::query();
        if ($request->status !== null) {
            $questions = $questions->where('status', $request->status);
        }
        if ($request->product_id) {
            $questions = $questions->where('product_id', $request->product_id);
        }
        $questions = $questions->with('messages')->with('product')->paginate(20);
        if ($request->ajax()) {
            $tableHtml = view('admin.product_questions.parts.table', ['questions' => $questions])->render();
            $params = $request->all();
            $paginationHtml = view('admin.product_questions.parts.pagination', compact('questions', 'params'))->render();
            return response()->json([
                'tableHtml' => $tableHtml,
                'paginationHtml' => $paginationHtml
            ]);
        }
        return view('admin.product_questions.index', compact('questions'));
    }

    public function view(Request $request, $id){
        $question = ProductQuestion::query()->findOrFail($id);
        if ($request->ajax()) {
            if (!$question) {
                return response()->json([
                    'status' => false,
                    'message' => 'Product question not found'
                ], 404);
            }
            $message = $question->messages->first()->message;
            $question = $question->toArray();
            $question['message'] = $message;
            return response()->json($question);
        }
        return view('admin.product_questions.question', compact('question'));
    }

    public function update(Request $request) {
        $question = ProductQuestion::query()->findOrFail($request->id);
        $question->update($request->all());
        $question->messages->first()->update(['message' => $request->message]);
        return redirect()->back()->with('success', 'Вопрос успешно отредактирован');
    }

    public function delete(Request $request, $id) {
        $question = ProductQuestion::query()->findOrFail($request->id);
        $question->delete();
        ProductQuestionMessage::query()->where('question_id', $id)->delete();
        return redirect()->back()->with('success', 'Вопрос успешно удален');
    }

    public function search_products(Request $request) {
        $products = Product::query()->select('product.title, product.id')
            ->join('product_questions', 'product_id', 'product.id')
            ->get();
    }
}
