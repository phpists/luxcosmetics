<?php

namespace App\Enums;

enum SeoTemplateEnum: string
{

    case CATEGORY = 'category';
    case PRODUCT = 'product';
    case BRAND = 'brand';
    case NEWS = 'news';
    case STATIC = 'static';
    case CART = 'cart';
    case REGISTER = 'register';
    case BOOKMARK = 'bookmark';


    /**
     * @throws \Exception
     */
    public function getReplaces(mixed $model)
    {
        return match ($this->value) {
            self::CATEGORY->value => [
                '{id}' => $model->id,
                '{name}' => $model->name,
                '{alias}' => $model->alias,
            ],
            self::PRODUCT->value => [
                '{id}' => $model->id,
                '{title}' => $model->title,
                '{alias}' => $model->alias,
                '{code}' => $model->code,
                '{code_1c}' => $model->code_1c,
                '{price}' => $model->price,
                '{old_price}' => $model->old_price,
                '{category}' => $model->category?->name,
                '{brand}' => $model->brand?->name,
            ],
            self::BRAND->value => [
                '{id}' => $model->id,
                '{name}' => $model->name,
                '{link}' => $model->link,
            ],
            self::NEWS->value => [
                '{id}' => $model->id,
                '{title}' => $model->title,
                '{link}' => $model->link,
                '{text}' => $model->text,
            ],
            self::STATIC->value => [
                '{id}' => $model->id,
                '{title}' => $model->title,
                '{link}' => $model->link,
            ],
            self::CART->value => [],
            self::REGISTER->value => [],
            self::BOOKMARK->value => [],
            default => throw new \Exception('Unexpected match value')
        };
    }

}
