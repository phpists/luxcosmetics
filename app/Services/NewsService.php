<?php

namespace App\Services;

use App\Models\NewsItem;

use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class NewsService
{
    public static function getNews(int $limit=null): \Illuminate\Database\Eloquent\Collection|LengthAwarePaginator|array
    {
        setlocale(LC_TIME, 'ru_RU.UTF-8');

        $news = NewsItem::query()
            ->where('status', true)
            ->orderBy('published_at', 'desc');

        if ($limit) {
            $news = $news->limit($limit)->get();
            $news->transform(function ($item) {
                $item->published_at = Carbon::parse($item->published_at);
                return $item;
            });
        }
        else {
            $news = $news->paginate();

            $news->getCollection()->transform(function ($item) {
                $item->published_at = Carbon::parse($item->published_at);
                return $item;
            });
        }

        return $news;
    }
}

