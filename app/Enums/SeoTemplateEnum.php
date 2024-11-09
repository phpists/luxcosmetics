<?php

namespace App\Enums;

use App\Models\SeoTemplate;
use Illuminate\Database\Eloquent\Model;

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
    case CATALOG = 'catalog';
    case PROMOTIONS = 'akcii';
    case PROMOTION_ARTICLE = 'akcii.article';


    /**
     * @throws \Exception
     */
    public function getReplaces(?Model $model)
    {
        return match ($this) {
            self::CATEGORY => [
                '{id}' => $model->id,
                '{name}' => $model->name,
                '{alias}' => $model->alias,
            ],
            self::PRODUCT => [
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
            self::BRAND => [
                '{id}' => $model->id,
                '{name}' => $model->name,
                '{link}' => $model->link,
            ],
            self::NEWS => [
                '{id}' => $model->id,
                '{title}' => $model->title,
                '{link}' => $model->link,
                '{text}' => $model->text,
            ],
            self::STATIC => [
                '{id}' => $model->id,
                '{title}' => $model->title,
                '{link}' => $model->link,
            ],
            self::PROMOTION_ARTICLE => [
                '{id}' => $model->id,
                '{title}' => $model->title,
                '{slug}' => $model->slug,
            ],
            default => []
        };
    }

    public function getModel()
    {
        return SeoTemplate::whereType($this->value)->firstOrFail();
    }

}
