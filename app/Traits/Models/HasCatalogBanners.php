<?php

namespace App\Traits\Models;

use App\Models\CatalogBannerCondition;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasCatalogBanners
{

    public function bannerConditions(): MorphMany
    {
        return $this->morphMany(CatalogBannerCondition::class, 'model')
            ->whereModelType(static::class)
            ->orderBy('row');
    }

    public function activeBannerConditions(): MorphMany
    {
        return $this->bannerConditions()
            ->active();
    }

}
