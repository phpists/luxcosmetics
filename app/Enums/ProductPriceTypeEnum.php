<?php

namespace App\Enums;

enum ProductPriceTypeEnum: string
{

    case DISCOUNT = 'discount';
    case BONUSES = 'bonuses';


    public function getTitle(): string
    {
        return match ($this) {
            self::DISCOUNT => 'Скидка',
            self::BONUSES => 'Бонусы',
        };
    }

}
