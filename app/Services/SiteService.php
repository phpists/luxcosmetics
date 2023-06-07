<?php

namespace App\Services;

use App\Enums\AvailableOptions;

class SiteService
{
    static public function getProductStatus(int $availability_option): string
    {
        return match ($availability_option) {
            AvailableOptions::NOT_AVAILABLE->value => 'Нет в наличии',
            AvailableOptions::DISCONTINUED->value => 'Снят с производства',
            default => 'Есть в наличии',
        };
    }

    static public function getStatus(bool $status) {
        return $status?'Активный': 'Не активный';
    }

    static public function getIsMain(bool $is_main) {
        return $is_main?"Да":"Нет";
    }
}
