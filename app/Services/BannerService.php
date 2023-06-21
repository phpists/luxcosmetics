<?php

namespace App\Services;

use App\Models\Banner;

use Carbon\Carbon;

class BannerService
{
    public static function getBanner()
{
    setlocale(LC_TIME, 'ru_RU.UTF-8');

    $banner = Banner::select('banners.*')
        ->where('status', true)
        ->paginate();

    $banner->getCollection()->transform(function ($item) {
        $item->published_at = Carbon::parse($item->published_at);
        return $item;
    });

    return $banner;
}

}

