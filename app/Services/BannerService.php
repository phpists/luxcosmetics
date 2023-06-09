<?php

namespace App\Services;

use App\Models\Banner;

use Carbon\Carbon;

class BannerService
{
    public static function getBanner()
{
    $banner = Banner::select('banners.*')
        ->where('status', true)
        ->orderBy('number_position')
        ->paginate();

    $banner->getCollection()->transform(function ($item) {
        $item->published_at = Carbon::parse($item->published_at);
        return $item;
    });

    return $banner;
}

}

