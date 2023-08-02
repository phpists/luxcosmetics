<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index($menu_type) {
        $menu_items = Menu::query()->where('type', $menu_type)->get();
        return view('admin.menu.index', compact('menu_items', 'menu_type'));
    }

    public function create(Request $request, $menu_type) {
        $menu_items = Menu::query()->where('type', $menu_type)->get();
        $pos = 1;
        if ($menu_items) {
            $pos = $menu_items->max(function ($item) {
                return $item->position;
            }) + 1;
        }
        return view('admin.menu.create', compact('menu_type', 'menu_items', 'pos'));
    }

    public function update(Request $request, $id) {
        $data = $request->all();
        $data['is_active'] = array_key_exists('is_active', $data)? 1 : 0;
        $menu = Menu::query()->findOrFail($id);
        if ($request->category_id !== null) {
            $category = Category::query()->find($data['category_id']);
            $data['link'] = route('categories.show', $category->alias, false);
        }
        if($menu->update($data))
            return redirect()->route('admin.menu', $menu->type)->with('success', 'Меню успешно обновлено');
        return redirect()->back()->with('error', 'Ну удалось обновить запись');
    }

    public function edit($id) {
        $item = Menu::query()->find($id);
        if (!$item) {
            abort('404');
        }
        $menu_items = Menu::query()->where('type', $item->type)->whereNot('id', $item->id)->get();
        return view('admin.menu.edit', compact('item', 'menu_items'));
    }

    public function store(Request $request) {
        $data = $request->all();
        $data['is_active'] = array_key_exists('is_active', $data)? 1 : 0;
        if ($request->category_id !== null) {
            $category = Category::query()->find($data['category_id']);
            $data['link'] = route('categories.show', $category->alias, false);
        }
        $menu = new Menu($data);
        if ($menu->save()) {
            return redirect()->route('admin.menu', $data['type'])->with('success', 'Меню удачно создано');
        }
        return redirect()->back('error', 'Не удалось сохранить запис');
    }

    public function updatePosition(Request $request) {
        foreach ($request->data as $pos => $new_position) {
            $parent_id = array_key_exists('parent_id', $new_position)?$new_position['parent_id']:null;
            $menu = Menu::query()->find($new_position['id']);
            $is_same_parent = false;
            if ($parent_id !== null) {
                $is_same_parent = ((int)$parent_id === (int)$menu->parent_id);
            }
            $data = [
                'position' => $pos
            ];
            if (!$is_same_parent) {
                $data['parent_id'] = $parent_id;
            }
            $menu->update($data);
        }
        return response()->json(['status' => 'ok']);
    }

    public function delete($id) {
        $menu = Menu::query()->findOrFail($id);
        Menu::query()->where('parent_id', $id)->update([
            'parent_id' => $menu->parent_id
        ]);
        $menu->delete();
        return redirect()->back()->with('success', 'Меню успешно удалено');
    }
}
