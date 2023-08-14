<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductQuestion;
use Illuminate\Http\Request;

class ProductQuestionController extends Controller
{
    public function answer(Request $request){

    }

    public function index(){
        $questions = ProductQuestion::query()->paginate(20);
        return view('admin.product_questions.index', compact('questions'));
    }
}
