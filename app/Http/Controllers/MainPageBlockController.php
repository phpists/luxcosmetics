<?php

namespace App\Http\Controllers;

use App\Models\MainPageBlock;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MainPageBlockController extends Controller
{
    public function index() {
        $blocks = MainPageBlock::query()->get();
        return view('admin.main_block.index', compact('blocks'));
    }

    public function update(Request $request) {
        $block = MainPageBlock::query()->find($request->id);
        $data = $request->all();
        if ($request->hasFile('image_path')) {
            $data['image_path'] = FileService::saveFile('uploads', 'main_block', $request->image_path);
            FileService::removeFile('uploads', 'main_block', $block->image_path);
        }

        if ($request->hasFile('video_path')) {
            $data['video_path'] = FileService::saveFile('uploads', 'main_block', $request->video_path);
            FileService::removeFile('uploads', 'main_block', $block->video_path);
        }
        $block->update($data);

        return redirect()->back()->with('success', 'Блок успешно обновлен');
    }

    public function show(Request $request) {
        $block = MainPageBlock::query()->find($request->id);
        return response()->json($block);
    }
}
