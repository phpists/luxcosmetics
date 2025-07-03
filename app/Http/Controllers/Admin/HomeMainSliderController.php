<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeMainSlider;
use App\Services\FileService;
use Illuminate\Http\Request;

class HomeMainSliderController extends Controller
{
    public function show(Request $request)
    {
        $data = $request->all();
        $item = HomeMainSlider::find($data['id']);

        if ($item) {
            $item->image = $item->getImage();
        }

        return response()->json([
            'item' => $item,
            'route' => route('admin.main-slider.update', $item->id),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['image'] = null;

        if ($request->hasFile('image')) {
            $image = FileService::saveFile('uploads', "home_main_slider", $request->image);
            $data['image'] = $image;
        }

        HomeMainSlider::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'link' => $data['link'],
            'btn_title' => $data['btn_title'],
            'file' => $data['image']
        ]);

        return redirect()->back()->with('success', 'Данные успешно сохранены');
    }

    public function update(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = FileService::saveFile('uploads', "best_sellers", $request->image);
            $params['file'] = $image;
        }

        $params['title'] = $data['title'];
        $params['description'] = $data['description'];
        $params['link'] = $data['link'];
        $params['btn_title'] = $data['btn_title'];

        HomeMainSlider::where('id', $data['id'])->update($params);

        return redirect()->back()->with('success', 'Данные успешно отредактированы');
    }

    public function destroy(Request $request, $id)
    {
        $item = HomeMainSlider::find($id);

        if ($item){
            $item->delete();
        }

        return redirect()->back()->with('success', 'Данные успешно удалены');
    }
}
