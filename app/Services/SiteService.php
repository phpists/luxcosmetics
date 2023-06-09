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

    static public function displayCardNumber(string $card_number) {
        $final_str = substr($card_number, 0, 4)." ****  **** ".substr($card_number, -4, 4);
        return $final_str;
    }

    static public function checkCardAvailability(string $valid_date) {
        $date = preg_split('~/~', $valid_date);
        if ((int)$date[0] > date('m') && (int)$date[1] > date('y')) {
            return 'Действительна до '.$valid_date;
        }
        return 'Не действительная';
    }
}
