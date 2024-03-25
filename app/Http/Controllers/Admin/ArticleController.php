<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\CategoryBanner;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{


    public function store(Request $request)
    {
        $data = $request->all();
        $image = FileService::saveFile('uploads', 'articles', $request->image);
        if ($image){
            $data['image'] = $image;
        }
        $data['is_active'] = array_key_exists('is_active', $data)?1:0;
        $article = new Article($data);
        $article->save();

        return redirect()->back();
    }

    public function show(Request $request) {
        $article = Article::query()->find($request->id);
        if (!$article) {
            return response()->json([
                'status' => false, 'message' => 'Запись не найдена'
            ], 404);
        }
        else {
            return response()->json($article);
        }
    }
    public function update(Request $request, Article $article)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = FileService::saveFile('uploads', 'articles', $request->file('image'));
            if ($image) {
                $data['image'] = $image;
            }
        }
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $article->update($data);
        return redirect()->back();
    }


    public function sort(Request $request)
    {
        $positions = $request->post('positions');

        if ($positions) {
            foreach ($positions as $position) {
                $model = Article::findOrFail($position['id']);
                $model->position = $position['position'];
                $model->save();
            }
        }
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');

        $article = Article::query()->findOrFail($id);

        $article->delete();

        FileService::removeFile('uploads', 'articles', $article->image);

        return redirect()->back()->with('success', 'Статья успешно удалена');
    }


}
