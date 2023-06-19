<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $pages = Page::query()->paginate();
        return view('admin.pages.index', compact('pages'));
    }

    public function store(Request $request) {
        $data = $request->all();
        $data['is_active'] = array_key_exists('is_active', $data);
        $page = new Page($data);
        $page->save();
        return redirect()->route('admin.pages.index')->with('success', 'Страница успешно создана');
    }

    public function create(){
        return view('admin.pages.create');
    }

    public function update(Request $request) {
        $page = Page::query()->find($request->id);
        if (!$page) {
            abort('404');
        }
        $data = $request->all();
        $data['is_active'] = array_key_exists('is_active', $data);
        $page->update($data);
        return redirect()->route('admin.pages.index')->with('success', 'Страница успешно обновлена');
    }

    public function edit(Request $request, $id) {
        $page = Page::query()->findOrFail($id);
        return view('admin.pages.edit', compact('page'));
    }

    public function delete(Request $request, $id) {
        $page = Page::query()->find($id);
        if (!$page) {
            abort('404');
        }
        $page->delete();
        return redirect()->back()->with('success', 'Страница успешно удалена');
    }
}
