<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Services\ImageService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index() {
        $tag = Tag::query()->paginate(15);

        return ;
    }

    public function store(Request $request) {
        $data = $request->all();
        $data['image_path'] = ImageService::saveImage('uploads', 'tags', $data['image_path']);
        $tag = new Tag($data);
        $tag->save();

        return redirect()->back()->with('success', 'Тег успешно создан');
    }

    public function show(Request $request) {
        $tag = Tag::query()->find($request->id);
        if (!$tag) {
            return response()->json(['status' => false], 404);
        }
        return response()->json($tag);
    }

    public function update(Request $request) {
        $tag = Tag::query()->find($request->id);
        $data = $request->all();
        if (!$tag) {
            return redirect()->back()->with('error', 'Записи с id '.$request->id.' не найденно');
        }
        if ($request->hasFile('image_path')) {
            $image = ImageService::saveImage('uploads', 'categories', $data['image_path']);
            if ($image) {
                $data['image_path'] = $image;
            }
            else {
                return redirect()->back()->with('error', 'Не удалось сохранить изображение');
            }
        }
        $tag->update($data);
        $tag->save();
        return redirect()->back()->with('success', 'Тег успешно создан');
    }

    public function delete(Request $request) {
        try {
            $tag = Tag::query()->find($request->id);
            if(!$tag) {
                return redirect()->back()->with('error', 'Нет записи с id '.$tag->id);
            }
            ImageService::removeImage('uploads', 'tags', $tag->image_path);
            $tag->delete();
            return redirect()->back()->with('success', 'Тег успешно удален');
        }
        catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Что пошло не так, обратитесь к разработчику');
        }

    }
}
