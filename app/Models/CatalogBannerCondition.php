<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CatalogBannerCondition extends Model
{

    protected $fillable = [
        'is_active',
        'model_id',
        'model_type',
        'row',
        'share_with_child',
    ];

    protected $casts = [
        'is_active' => 'bool',
        'share_with_child' => 'bool',
    ];


    public function scopeActive(Builder $query)
    {
        $query->where('is_active', 1);
    }

    public function banners(): BelongsToMany
    {
        return $this->belongsToMany(CatalogBanner::class, 'catalog_banner_condition_catalog_banner');
    }

    public function randomBanner()
    {
        return $this->hasOneThrough(
            CatalogBanner::class,
            CatalogBannerConditionCatalogBanner::class,
            'catalog_banner_condition_id',
            'id',
            'id',
            'catalog_banner_id'
        )
            ->inRandomOrder();
    }

}
