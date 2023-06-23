<?php

namespace App\Services;

use App\Models\Product;
use App\Models\UserFavoriteProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FavoriteProductsService
{

    public static function getAllIds()
    {
        if ($user_id = Auth::id()) {
            return UserFavoriteProduct::where('user_id', $user_id)->pluck('product_id', 'id') ?? [];
        } else {
            return session()->get('favorite_products', []);
        }
    }

    public static function getTotalCount()
    {
        return count(self::getAllIds());
    }

    public static function isNotEmpty()
    {
        return count(self::getAllIds()) > 0;
    }

    public static function migrateIntoDb($user_id)
    {
        $db_ids = UserFavoriteProduct::where('user_id', $user_id)->pluck('product_id', 'id') ?? [];
        $ids_to_add = array_diff(session()->get('favorite_products', []), $db_ids->toArray());

        foreach ($ids_to_add as $id) {
            UserFavoriteProduct::create([
                'user_id' => $user_id,
                'product_id' => $id
            ]);
        }
    }

    public static function setById($product_id)
    {
        if ($product_id) {
            $current_products = session()->get('favorite_products', []);
            if (!in_array($product_id, $current_products))
                $current_products = array_merge($current_products, [$product_id]);

            session(['favorite_products' => $current_products]);

            if ($user_id = Auth::id()) {
                if (!UserFavoriteProduct::where(['user_id' => $user_id, 'product_id' => $product_id])->exists()) {
                    UserFavoriteProduct::create([
                        'user_id' => $user_id,
                        'product_id' => $product_id
                    ]);
                }
            }
        }

        return self::getTotalCount();
    }

    public static function removeById($product_id)
    {
        if ($product_id) {
            $current_products = session()->get('favorite_products', []);
            $key = array_search($product_id, $current_products);
            if ($key !== false)
                unset($current_products[$key]);

            session(['favorite_products' => $current_products]);

            if ($user_id = Auth::id()) {
                $model = UserFavoriteProduct::where(['user_id' => $user_id, 'product_id' => $product_id])->first();
                Log::info($user_id);
                Log::info($product_id);
                Log::info(json_encode($model));
                if ($model) {
                    $model->delete();
                }
            }
        }

        return self::getTotalCount();
    }

    public static function checkByIdForAnonym($product_id) {
        if (Auth::check()) {
            return true;
        }
        return in_array($product_id, session()->get('favorite_products', []));
    }

    public static function checkById($product_id)
    {
        if ($user_id = Auth::id())
            return UserFavoriteProduct::where(['user_id' => $user_id, 'product_id' => $product_id])->exists();
        else
            return in_array($product_id, session()->get('favorite_products', []));
    }


}
