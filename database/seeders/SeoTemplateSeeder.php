<?php

namespace Database\Seeders;

use App\Enums\SeoTemplateEnum;
use App\Models\SeoTemplate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeoTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seoTemplates = [
            [
                'type' => SeoTemplateEnum::CATEGORY->value,
                'hint' => "Допустимые переменные:\r\n {id] = ID категории;\r\n {name} = название категории;\r\n {alias} = URL категории",
                'title' => '',
                'description' => '',
            ],
            [
                'type' => SeoTemplateEnum::PRODUCT->value,
                'hint' => "Допустимые переменные:\r\n {id} = ID товара;\r\n {title} = название товара;\r\n {alias} = URL категории;\r\n {code} = артикул товара;\r\n {code_1c} = артикул товара в 1С;\r\n {price} = цена товара;\r\n {old_price} = старая цена товара;\r\n {category} = название категории товара;\r\n {brand} = название бренда товара",
                'title' => '',
                'description' => '',
            ],
            [
                'type' => SeoTemplateEnum::BRAND->value,
                'hint' => "Допустимые переменные:\r\n {id} = ID бренда;\r\n {name} = название бренда;\r\n {link} = URL бренда",
                'title' => '',
                'description' => '',
            ],
            [
                'type' => SeoTemplateEnum::NEWS->value,
                'hint' => "Допустимые переменные:\r\n {id} = ID новости;\r\n {title} = название новости;\r\n {link} = URL новости;\r\n {text} = текст новости",
                'title' => '',
                'description' => '',
            ],
            [
                'type' => SeoTemplateEnum::STATIC->value,
                'hint' => "Допустимые переменные:\r\n {id} = ID страницы;\r\n {title} = название страницы;\r\n {link} = URL страницы",
                'title' => '',
                'description' => '',
            ],
            [
                'type' => SeoTemplateEnum::CART->value,
                'hint' => '',
                'title' => '',
                'description' => '',
            ],
            [
                'type' => SeoTemplateEnum::REGISTER->value,
                'hint' => '',
                'title' => '',
                'description' => '',
            ],
            [
                'type' => SeoTemplateEnum::BOOKMARK->value,
                'hint' => '',
                'title' => '',
                'description' => '',
            ],
        ];

        foreach ($seoTemplates as $seoTemplate) {
            if (!SeoTemplate::whereType($seoTemplate['type'])->exists())
                SeoTemplate::create($seoTemplate);
        }
    }
}
