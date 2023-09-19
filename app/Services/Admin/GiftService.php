<?php

namespace App\Services\Admin;

use App\Models\GiftCondition;
use App\Models\GiftProduct;

class GiftService
{

    public function getGiftProducts()
    {
        $query = GiftProduct::query();

        $request = request();
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('article', 'LIKE', "%{$search}%")
                ->orWhere('title', 'LIKE', "%{$search}%")
                ->orWhereHas('brand', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                });
        }

        return $query->paginate();
    }

    public function getGiftConditions()
    {
        return GiftCondition::paginate();
    }

}
