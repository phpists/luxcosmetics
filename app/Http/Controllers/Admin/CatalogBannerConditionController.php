<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CatalogBanner;
use App\Models\CatalogBannerCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CatalogBannerConditionController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(CatalogBannerCondition::class);
    }

    public function store(Request $request)
    {
        $data = $request->post();
        $data['is_active'] = $request->boolean('is_active');
        $data['share_with_child'] = $request->boolean('share_with_child');

        $catalogBannerCondition = new CatalogBannerCondition($data);
        if ($catalogBannerCondition->save()) {
            $bannerIds = $data['banner_ids'];
            $catalogBannerCondition->banners()->attach($bannerIds);

            return back()->with('success', 'Условие баннера добавлено');
        }

        return back()->with('error', 'Не удалось добавить условие');
    }

    public function show(CatalogBannerCondition $catalogBannerCondition)
    {
        $data = $catalogBannerCondition->toArray();
        $data['bannerIds'] = $catalogBannerCondition->banners()->pluck('catalog_banners.id')->toArray();

        return Response::json($data);
    }

    public function update(Request $request, CatalogBannerCondition $catalogBannerCondition)
    {
        $data = $request->post();
        $data['is_active'] = $request->boolean('is_active');
        $data['share_with_child'] = $request->boolean('share_with_child');

        if ($catalogBannerCondition->update($data)) {
            $bannerIds = $data['banner_ids'];
            $catalogBannerCondition->banners()->sync($bannerIds);

            return back()->with('success', 'Условие баннера добавлено');
        }

        return back()->with('error', 'Не удалось добавить условие');
    }

    public function updateSwitch(Request $request, CatalogBannerCondition $catalogBannerCondition)
    {
        $this->authorize('update', $catalogBannerCondition);

        $data = array_map(function($item) {
            return $item === 'true';
        }, $request->post());

        $catalogBannerCondition->update($data);
    }

    public function destroy(Request $request, CatalogBannerCondition $catalogBannerCondition)
    {
        $catalogBannerCondition->banners()->detach();
        if ($catalogBannerCondition->delete())
            return back()->with('success', 'Условие удалено');

        return back()->with('error', 'Не удалось добавить условие');
    }

}
