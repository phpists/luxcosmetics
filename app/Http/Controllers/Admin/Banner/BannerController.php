<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Services\ImageService;
use App\Services\SiteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $banner = Banner::query();

        if (isset($request->position)) {
            $banner->where('banners.position', $request->position);
        }
        $banner = $banner->paginate($request->paginate ?? 100);

        if ($request->ajax()) {
            $bannerAjaxHtml = view('admin.banner.parts.table', ['bannerAjax' => $banner])->render();
            $paginateHtml = view('admin.banner.parts.paginate', ['bannerAjax' => $banner, 'params' => $request->all()])->render();

            return response()->json([
                'bannerAjaxHtml' => $bannerAjaxHtml,
                'paginateHtml' => $paginateHtml,
            ]);
        }

        return response()->view('admin.banner.index', compact('banner'));
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'text' => 'required',
        ]);

        Banner::create([
            'title' => $request->title,
            'text' => $validatedData['text'],
            'link' => $request->link,
            'status' => $request->status,
            'position' => $request->position,
            'number_position' => $request->number_position,
            'image' => ImageService::saveImage('uploads', "banner", $request->image),
            'published_at' => $request->published_at
        ]);


        return redirect()->route('admin.banner')->with('success', 'Данные успешно сохранены');
    }

    public function edit($id)
    {
        $data['item'] = Banner::select('banners.*')->where('banners.id', $id)->first();
        return view('admin.banner.edit', $data);
    }

    public function update(Request $request)
    {
        $item = Banner::find($request->id);
        if ($request->hasFile('image')) {
            $image = ImageService::saveImage('uploads', "banner", $request->image);
            $item->image = $image;
            $item->update(['image' => $image]);
        }else{
            $item->update($request->all());
        }

        return redirect()->route('admin.banner')->with('success', 'Данные успешно отредактированы');
    }

    public function delete($id)
    {
        $item = Banner::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.banner')->with('success', 'Данные успешно удалены');
    }

    public function activePosts(Request $request)
    {
        $id = $request->id;
        $bannerId = $request->checkbox;
        $status = $request->status;

        if ($id) {
            Banner::where('id', $id)->update([
                'status' => $status
            ]);
        } elseif ($bannerId) {
            Banner::whereIn('id', $bannerId)->update([
                'status' => $status
            ]);
        }

        $title = SiteService::statusBanner($status);
        $message = $status ? 'Баннер активирован!' : 'Баннер деактивирован!';

        $data = [
            'posts' => $id ?? $bannerId,
            'title' => $title,
            'message' => $message
        ];

        return json_encode($data);
    }

    public function updatePosition(Request $request) {
        $pos_table = [];
        $positions = $request->positions;
        foreach ($positions as $key => $position) {
            if (!array_key_exists($position['cat_id'], $pos_table)) {
                $pos_table[$position['cat_id']] = 1;
            }
            Banner::query()->where('id', $position['id'])
                ->update([
                    'number_position' => $pos_table[$position['cat_id']]
                ]);
            $positions[$key]['position'] = $pos_table[$position['cat_id']];
            $pos_table[$position['cat_id']] += 1;
        }

        return $positions;
    }
}
