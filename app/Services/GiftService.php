<?php

namespace App\Services;

use App\Models\Category;
use App\Models\GiftCondition;
use Illuminate\Support\Collection;

class GiftService
{

    const UNIQUE_GIFTS = true;

    public $conditions;


    public function __construct()
    {
        $this->conditions = GiftCondition::whereHas('products', function ($query) {
                $query->available();
            })->get();
    }


    public function getGiftProducts($cart_products, $cart_sum): Collection
    {
        $gift_products = new Collection();

        foreach ($this->conditions as $condition) {
            if ($this->checkCondition($condition, $cart_products, $cart_sum))
                $gift_products = $gift_products->merge($condition->products);
        }

        return self::UNIQUE_GIFTS
            ? $gift_products->unique('id')
            : $gift_products;
    }



    private function checkCondition(GiftCondition $condition, $cart_products, $cart_sum): bool
    {
        switch ($condition->type) {
            case GiftCondition::TYPE_SUM:
                $is_min = !$condition->min_sum || $cart_sum > $condition->min_sum;
                $is_max = !$condition->max_sum || $cart_sum < $condition->max_sum;
                return $is_min && $is_max;
            case GiftCondition::TYPE_BRAND:
                $is_main = $cart_products
                    ->whereIn('brand_id', $condition->conditionCases()->pluck('foreign_id')->toArray())
                    ->isNotEmpty();
                $is_min = !$condition->min_sum || $cart_sum > $condition->min_sum;
                $is_max = !$condition->max_sum || $cart_sum < $condition->max_sum;

                return $is_main && $is_min && $is_max;
            case GiftCondition::TYPE_CATEGORY:
                $cart_categories = $this->getCartProductsCategories($cart_products);
                $condition_categories = $condition->cases->pluck('id')->toArray();
                $is_main = count(array_intersect($condition_categories, $cart_categories)) > 0;
                $is_min = !$condition->min_sum || $cart_sum > $condition->min_sum;
                $is_max = !$condition->max_sum || $cart_sum < $condition->max_sum;

                return $is_main && $is_min && $is_max;
            case GiftCondition::TYPE_PRODUCT:
                $is_main = $cart_products
                    ->whereIn('id', $condition->conditionCases()->pluck('foreign_id')->toArray())
                    ->isNotEmpty();
                $is_min = !$condition->min_sum || $cart_sum > $condition->min_sum;
                $is_max = !$condition->max_sum || $cart_sum < $condition->max_sum;

                return $is_main && $is_min && $is_max;
            default:
                return false;
        }
    }

    private function getCartProductsCategories($cart_products): array
    {
        $all_categories = [];

        foreach ($cart_products as $cart_product) {
            $all_categories = array_merge($all_categories, Category::getChildIds($cart_product->category_id));
            $additional_categories = $cart_product->categories()->select('product_categories.category_id')->pluck('category_id')->toArray();
            foreach ($additional_categories as $additional_category) {
                $all_categories = array_merge($all_categories, Category::getChildIds($additional_category));
            }
        }

        return array_unique($all_categories);
    }


}
