<?php

namespace App\Http\Controllers;

use App\Models\Banner;

class BannerController extends Controller
{
    public function show($link)
    {
        $item = Banner::where('link', $link)->firstOrFail();
        return view('banner', compact('item'));
    }
}
