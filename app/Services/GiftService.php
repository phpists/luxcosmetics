<?php

namespace App\Services;

use App\Models\Category;
use App\Models\GiftCondition;
use App\Models\GiftConditionException;
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


    public function getGiftProducts($cart_products): Collection
    {
        $gift_products = new Collection();
        $cart_sum = 0;


        foreach ($this->conditions as $condition) {
            if ($cart_products->isNotEmpty()) {
                $cart_products = $this->filterCartProducts($cart_products, $condition);
                $cart_sum = $cart_products->sum('total_sum');
            }

            if ($this->checkCondition($condition, $cart_products, $cart_sum))
                $gift_products = $gift_products->merge($condition->products);
        }

        return self::UNIQUE_GIFTS
            ? $gift_products->unique('id')
            : $gift_products;
    }


    private function filterCartProducts($cart_products, $condition) {
        $exceptions = $condition->conditionExceptions;
        $filtered_cart_products = $cart_products;

        $brand_exceptions = $exceptions->where('type', GiftConditionException::TYPE_BRAND)->pluck('foreign_id')->toArray();
        if (count($brand_exceptions) > 0) {
            $filtered_cart_products = $filtered_cart_products->reject(function ($product) use ($brand_exceptions) {
                return in_array($product->brand_id, $brand_exceptions);
            });
        }

        $upper_category_exceptions = $exceptions->where('type', GiftConditionException::TYPE_CATEGORY)->pluck('foreign_id')->toArray();
        if (count($upper_category_exceptions) > 0) {
            $category_exceptions = [];
            foreach ($upper_category_exceptions as $upper_category_exception) {
                $category_exceptions = array_merge($category_exceptions, Category::getChildIds($upper_category_exception));
            }
            $filtered_cart_products = $filtered_cart_products->reject(function ($product) use ($category_exceptions) {
                return $product->productCategories->whereIn('category_id', $category_exceptions)->isNotEmpty()
                    || in_array($product->category_id, $category_exceptions);
            });
        }

        $product_exceptions = $exceptions->where('type', GiftConditionException::TYPE_PRODUCT)->pluck('foreign_id')->toArray();
        if (count($product_exceptions) > 0) {
            $filtered_cart_products = $filtered_cart_products->reject(function ($product) use ($product_exceptions) {
                return in_array($product->id, $product_exceptions);
            });
        }

        return $filtered_cart_products;
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
                $condition_categories_cases = $condition->cases->pluck('id')->toArray();
                $condition_categories = [];
                foreach ($condition_categories_cases as $condition_categories_case) {
                    $condition_categories = array_merge($condition_categories, Category::getChildIds($condition_categories_case));
                }
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
