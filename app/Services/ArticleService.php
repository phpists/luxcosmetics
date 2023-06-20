<?php

namespace App\Services;

use App\Models\Article;

use Carbon\Carbon;

class ArticleService
{
    public static function getArticle()
    {
        setlocale(LC_TIME, 'ru_RU.UTF-8');

        $article = Article::select('articles.*')
            ->where('status', true)
            ->paginate();

        $article->getCollection()->transform(function ($item) {
            $item->published_at = Carbon::parse($item->published_at)->format('d.F.Y');
            return $item;
        });

        return $article;
    }
}

