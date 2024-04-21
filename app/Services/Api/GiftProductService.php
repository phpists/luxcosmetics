<?php

namespace App\Services\Api;

use App\Models\Brand;
use App\Models\GiftProduct;

class GiftProductService
{

    function import($data)
    {
        foreach ($data['gift-products'] as $giftProduct) {
            $brandTitle = $giftProduct['brand_title'];
            $brand = Brand::firstOrCreate([
                'name' => $brandTitle
            ], [
                'link' => \Str::slug($brandTitle)
            ]);

            $giftProduct['brand_id'] = $brand->id;
            unset($giftProduct['brand_title']);

            GiftProduct::updateOrCreate([
                'article' => $giftProduct['article'],
            ], $giftProduct);
        }
    }

}
