<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Services\FileService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index() {
        $tag = Tag::query()->paginate(15);

        return ;
    }

    public function store(Request $request) {
        $data = $request->all();
        if (array_key_exists('image_path', $data)) {
            $data['image_path'] = FileService::saveFile('uploads', 'tags', $data['image_path']);
        }
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
            $image = FileService::saveFile('uploads', 'tags', $data['image_path']);
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

    public function updatePosition(Request $request){
        $data = $request->positions;
        foreach ($data as $element) {
            Tag::query()->where('id', $element['id'])->update([
                'position' => $element['position'],
                'add_to_top' => $element['add_to_top']
            ]);
        }
        return response()->json([
            'status' => true
        ]);
    }

    public function delete(Request $request) {
        try {
            $tag = Tag::query()->find($request->id);
            if(!$tag) {
                if ($request->ajax()) {
                    return response()->json([
                        'status' => false,
                        'error' => 'tag not found'
                    ], 404);
                }
                return redirect()->back()->with('error', 'Нет записи с id '.$tag->id);
            }
            FileService::removeFile('uploads', 'tags', $tag->image_path);
            $tag->delete();
            if ($request->ajax()) {
                return response()->json([
                    'success' => true
                ]);
            }
            return redirect()->back()->with('success', 'Тег успешно удален');
        }
        catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Что пошло не так, обратитесь к разработчику');
        }

    }
}
