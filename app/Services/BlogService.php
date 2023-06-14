<?php

namespace App\Services;

use App\Models\BlogItem;

use Carbon\Carbon;

class BlogService
{
    public static function getBlog()
    {
        setlocale(LC_TIME, 'ru_RU.UTF-8');

        $blog = BlogItem::select('blog_items.*')
            ->where('status', true)
            ->paginate();

        $blog->getCollection()->transform(function ($item) {
            $item->published_at = Carbon::parse($item->published_at)->formatLocalized('%d %B %Y');
            return $item;
        });

        return $blog;
    }
}

