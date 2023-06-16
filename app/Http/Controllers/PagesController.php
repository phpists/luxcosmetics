<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function show($link) {
        $page = Page::query()->where('link', $link)->first();
        if (!$page) {
            abort('404');
        }
        return view('page', compact('page'));
    }
}
