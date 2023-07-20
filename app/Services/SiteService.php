<?php

namespace App\Services;

use App\Enums\AvailableOptions;
use App\Enums\ConnectionOptions;
use App\Models\Menu;
use Illuminate\Support\Facades\Log;

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

    static public function statusBanner(bool $status) {
        Log::alert($status);
        if ($status) {
            return '<span><i class="las la-eye"></i></span>';
        } else {
            return '<span><i class="las la-eye-slash"></i></span>';
        }
    }
    static public function statusNews(bool $status) {
        Log::alert($status);
        if ($status) {
            return '<span><i class="las la-eye"></i></span>';
        } else {
            return '<span><i class="las la-eye-slash"></i></span>';
        }
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

    static public function getChatStatus(int $status): string
    {
        return match ($status) {
            1 => 'Новый',
            2 => 'Просмотрен',
            3 => 'Закрыт',
        };
    }

    static public function getMenuType(int $menu_type): string
    {
        return match ($menu_type) {
            Menu::TOP_MENU => 'Верхнее меню',
            Menu::FOOTER_MENU => 'Нижнее меню'
        };
    }

    static public function getConnectionOption(int $connection_option): string
    {
        return match ($connection_option) {
            ConnectionOptions::EMAIL->value => 'Почта',
            ConnectionOptions::SMS->value => 'SMS',
            ConnectionOptions::PHONE->value => 'Телефон',
            ConnectionOptions::WHATSAPP->value => 'Whatsapp'
        };
    }
}
