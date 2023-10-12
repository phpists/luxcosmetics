<?php

namespace App\Services;

use App\Models\NewsItem;

use Carbon\Carbon;

class NewsService
{
    public static function getNews()
    {
        setlocale(LC_TIME, 'ru_RU.UTF-8');

        $news = NewsItem::query()
            ->select('news_item.*')
            ->where('status', true)
            ->orderBy('published_at', 'desc')
            ->paginate();

        $news->getCollection()->transform(function ($item) {
            $item->published_at = Carbon::parse($item->published_at);
            return $item;
        });

        return $news;
    }
}

