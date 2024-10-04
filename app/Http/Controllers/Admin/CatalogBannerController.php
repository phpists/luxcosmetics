<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CatalogBannerTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\CatalogBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class CatalogBannerController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(CatalogBanner::class);
    }

    public function index()
    {
        return view('admin.catalog-banners.index', [
            'catalogBanners' => CatalogBanner::paginate(),
        ]);
    }

    public function loadType(Request $request, string $type)
    {
        $this->authorize('view', new CatalogBanner);

        $id = $request->query('id');
        $catalogBanner = $id ? CatalogBanner::find($id) : new CatalogBanner;

        $selector = $request->query('selector', 'createModal');

        return view("admin.catalog-banners.types.$type", [
            'selector' => $selector,
            'catalogBanner' => $catalogBanner,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->post('data');
        $banner = new CatalogBanner($request->post());
        $banner->data = $this->handleDataUpload($request, $banner, $data);

        if ($banner->save()) {
            return to_route('admin.catalog-banners.index')->with('success', 'Баннер успешно создан');
        }

        return back()->with('error', 'Не удалось создать баннер');
    }

    public function show(Request $request, CatalogBanner $catalogBanner)
    {
        return Response::json($catalogBanner);
    }

    public function update(Request $request, CatalogBanner $catalogBanner)
    {
        $catalogBanner->type = $request->post('type');
        $catalogBanner->title = $request->post('title');
        $catalogBanner->data = $this->handleDataUpload($request, $catalogBanner, $request->post('data'));

        if ($catalogBanner->save()) {
            return to_route('admin.catalog-banners.index')->with('success', 'Изменения успешно сохранены');
        }

        return back()->with('error', 'Не удалось сохранить изменения');
    }

    public function destroy(Request $request, CatalogBanner $catalogBanner)
    {
        if ($catalogBanner->delete()) {
            return to_route('admin.catalog-banners.index')->with('success', 'Баннер успешно удален');
        }

        return back()->with('error', 'Не удалось удалить баннер');
    }

    private function handleDataUpload(Request $request, CatalogBanner $banner, array $data): array
    {
        if (in_array($banner->type, [CatalogBannerTypeEnum::CATALOG_CARD->value, CatalogBannerTypeEnum::FULL_BLOCK->value])) {
            $this->handleFile($request, $data, $banner, 'img');
        } elseif ($banner->type === CatalogBannerTypeEnum::HORIZONTAL_IMG->value) {
            $this->handleFile($request, $data, $banner, 'img_960');
            $this->handleFile($request, $data, $banner, 'img_768');
            $this->handleFile($request, $data, $banner, 'img_375');
        }

        return $data;
    }

    private function handleFile(Request $request, array &$data, CatalogBanner $banner, string $key)
    {
        if (isset($data[$key])) {
            $data[$key] = $banner->data[$key];
        } else {
            $file375 = $request->file("data.$key");
            if ($file375 && Storage::disk('uploads')->put(CatalogBanner::IMAGES_PATH, $file375)) {
                $data[$key] = $file375->hashName();

                if (isset($banner->data[$key]))
                    Storage::disk('uploads')->delete(CatalogBanner::IMAGES_PATH . '/' . $banner->data[$key]);
            }
        }
    }

}
