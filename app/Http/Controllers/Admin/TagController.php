<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index() {
        $tag = Tag::query()->paginate(15);

        return ;
    }

    public function store(Request $request) {
        $tag = new Tag($request->all());

        $tag->save();

        return redirect()->back()->with('success', 'Тег успешно создан');
    }

    public function show($id) {
        $tag = Tag::query()->find($id);
        if (!$tag) {
            return response()->json(['status' => false], 404);
        }
        return response()->json($tag);
    }

    public function update(Request $request) {
        $tag = Tag::query()->find($request->id);
        if (!$tag) {
            return redirect()->back()->with('error', 'Записи с id '.$request->id.' не найденно');
        }
        $tag->update($request->all());
        $tag->save();
        return redirect()->back()->with('success', 'Тег успешно создан');
    }

    public function delete(Request $request) {

    }
}
