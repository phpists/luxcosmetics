<?php

namespace App\Enums;

enum CatalogBannerTypeEnum: string
{

    case HORIZONTAL_IMG = 'horizontal_img';
    case CATALOG_CARD = 'catalog_card';
    case ADVANTAGES = 'advantages';
    case FULL_BLOCK = 'full_block';


    public function getTitle(): string
    {
        return match ($this) {
            self::HORIZONTAL_IMG => 'Горизонтальное изображение',
            self::CATALOG_CARD => 'Карточка товара',
            self::ADVANTAGES => 'Преимущества',
            self::FULL_BLOCK => 'Полноценный блок',
        };
    }

}
