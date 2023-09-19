<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Services\FileService;
use App\Services\SiteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryPostsController extends Controller
{
    public function show($id){
        $post = CategoryPost::query()->find($id);
        if ($post) {
            return response()->json($post);
        }
        return response()->json([
            'status' => false,
            'error' => "category post with id $id was not found"
        ], 404);
    }

    public function update(Request $request) {
        $cat_post = CategoryPost::query()->findOrFail($request->id);
        $data = $request->all();
        $data['is_active'] = (int)$data['is_active'];

        if (array_key_exists('image_path', $data)) {
            $data['image_path'] = FileService::saveFile('uploads', 'category_posts', $data['image_path']);
            FileService::removeFile('uploads', 'category_posts', $cat_post->image_path);

        }
        if ($cat_post->update($data)) {
            return redirect()->back()->with('success', 'Пост для категории успешно обновлен');
        }
        return redirect()->back()->with('error', 'Не удалось обновить категорию');
    }

    public function store(Request $request) {
        $data = $request->all();
        $data['image_path'] = FileService::saveFile('uploads', 'category_posts', $data['image_path']);
        $position = CategoryPost::query()->where('category_id', $data['category_id'])->max('position');
        $data['position'] = $position? $position + 1: 1;
        $cat_post = new CategoryPost($data);
        if ($cat_post->save()) {
            return redirect()->back()->with('success', 'Пост для категории успешно создан');
        }
        return redirect()->back()->with('error', 'Не удалось создать пост');
    }

    public function delete(Request $request) {
        CategoryPost::query()->where('id', $request->id)->delete();
        return redirect()->back()->with('success', 'Пост успешно удален');
    }

    public function updatePosition(Request $request) {
        $positions = $request->positions;
        foreach ($positions as $key => $position) {
            CategoryPost::query()->where('id', $key)
                ->update([
                    'position' => $position
                ]);
        }

        return $positions;
    }

    public function updateStatus(Request $request) {
        CategoryPost::query()->find($request->id)->update([
            'status' => $request->status
        ]);
        return response()->json([
            'success' => true
        ]);
    }
}
