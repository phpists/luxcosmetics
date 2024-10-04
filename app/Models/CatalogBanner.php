<?php

namespace App\Models;

use App\Enums\CatalogBannerTypeEnum;
use App\Services\FileService;
use Illuminate\Database\Eloquent\Model;

class CatalogBanner extends Model
{

    const IMAGES_PATH = 'catalog-banners';

    const ALIGN_LEFT = 'left';
    const ALIGN_CENTER = 'center';
    const ALIGN_RIGHT = 'right';
    const ALL_ALIGNS = [
        self::ALIGN_LEFT => 'Слева',
        self::ALIGN_CENTER => 'По центру',
        self::ALIGN_RIGHT => 'Справа',
    ];

    const COLOR_ORIGINAL = 'original';
    const COLOR_GREEN = 'green';
    const ALL_COLORS = [
        self::COLOR_ORIGINAL => 'Оригинал',
        self::COLOR_GREEN => 'Зеленый',
    ];


    protected $fillable = [
        'type',
        'title',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];



    protected static function booted (): void
    {
        self::deleted(function(self $model) {
            if (in_array($model->type, [CatalogBannerTypeEnum::CATALOG_CARD->value, CatalogBannerTypeEnum::FULL_BLOCK->value])) {
                if (isset($model->data['img']))
                    FileService::removeFile('uploads', self::IMAGES_PATH, $model->data['img']);
            } elseif ($model->type === CatalogBannerTypeEnum::HORIZONTAL_IMG->value) {
                if (isset($model->data['img_960']))
                    FileService::removeFile('uploads', self::IMAGES_PATH, $model->data['img_960']);
                if (isset($model->data['img_768']))
                    FileService::removeFile('uploads', self::IMAGES_PATH, $model->data['img_768']);
                if (isset($model->data['img_375']))
                    FileService::removeFile('uploads', self::IMAGES_PATH, $model->data['img_375']);
            }
        });
    }


    public function getTypeTitleAttribute(): ?string
    {
        return CatalogBannerTypeEnum::tryFrom($this->type)?->getTitle();
    }

    public function getImgSrc(string $fileName)
    {
        return asset("images/uploads/" . $this::IMAGES_PATH . '/' . $fileName);
    }

}
