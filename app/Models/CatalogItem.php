<?php

namespace App\Models;

use App\Services\FileService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class CatalogItem extends Model
{
    const IMAGES_PATH = 'catalog-items';

    protected $fillable = [
        'title',
        'img',
        'pos',
        'links',
        'is_active',
    ];

    protected $casts = [
        'links' => 'array',
    ];

    protected static function booted (): void
    {
        static::addGlobalScope('positionSorted', function (Builder $builder) {
            $builder->orderBy('pos');
        });

        self::deleted(function(self $model) {
            if ($model->img)
                FileService::removeFile('uploads', self::IMAGES_PATH, $model->img);
        });
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function imgSrc(): Attribute
    {
        return Attribute::get(fn () => asset("images/uploads/" . $this::IMAGES_PATH . '/' . $this->img));
    }
}
