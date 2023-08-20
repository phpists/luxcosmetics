<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Services\FileService;
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
            'image' => FileService::saveFile('uploads', "banner", $request->image),
            'published_at' => $request->published_at
        ]);


        return redirect()->route('admin.banner')->with('success', 'Данные успешно сохранены');
    }

    public function edit($id)
    {
        $data['item'] = Banner::select('banners.*')->where('banners.id', $id)->first();
        $seo = Banner::query()->select('banners.*')->find($id);
        return view('admin.banner.edit', $data, compact('seo'));
    }

    public function update(Request $request)
    {
        $item = Banner::query()->find($request->id);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = FileService::saveFile('uploads', "banner", $request->image);
            $data['image'] = $image;
        }
        if ($request->hasFile('small_img')) {
            $image = FileService::saveFile('uploads', "banner", $request->small_img);
            $data['small_img'] = $image;
        }
        if ($request->hasFile('medium_img')) {
            $image = FileService::saveFile('uploads', "banner", $request->medium_img);
            $data['medium_img'] = $image;
        }
        $item->update($data);

        return redirect()->route('admin.banner')->with('success', 'Данные успешно отредактированы');
    }

    public function updateSeo(Request $request)
    {
        $productId = $request->input('id');

        $seo = Banner::find($productId);

        if ($seo === null) {
            return redirect()->back()->with('error', 'Продукт не найден.');
        }

        $seo->description_meta = $request->description_meta;
        $seo->keywords_meta = $request->keywords_meta;
        $seo->save();

        return redirect()->back()->with('success', 'Seo обновлено');
    }

    public function updateMicroSeo(Request $request)
    {
        $productId = $request->input('id');

        $microSeo = Banner::find($productId);

        if ($microSeo === null) {
            return redirect()->back()->with('error', 'Продукт не найден.');
        }

        $microSeo->og_title_meta = $request->og_title_meta;
        $microSeo->og_description_meta = $request->og_description_meta;
        $microSeo->save();

        return redirect()->back()->with('success', 'Seo обновлено');
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
