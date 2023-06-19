<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index() {
        return view('questions.faq');
    }

    public function delivery() {
        $page = Page::query()->where('link', 'delivery')->first();
        return view('questions.main', [
            'page' => $page
        ]);
    }

    public function returns() {
        $page = Page::query()->where('link', 'returns')->first();
        return view('questions.main', [
            'page' => $page
        ]);
    }

    public function policy() {
        $page = Page::query()->where('link', 'policy')->first();
        return view('questions.main', [
            'page' => $page
        ]);
    }
}
