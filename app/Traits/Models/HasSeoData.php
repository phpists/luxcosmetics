<?php

namespace App\Traits\Models;

use App\Models\SeoData;

trait HasSeoData
{
    protected static function bootHasSeoData(): void
    {
        static::created(function (self $model) {
            $model->seo()->create();
        });

        static::deleted(function (self $model) {
            $model->seo?->delete();
        });
    }

    public function seo()
    {
        return $this->morphOne(SeoData::class, 'seoable');
    }
}
