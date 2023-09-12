<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Services\Admin\GiftService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class GiftController extends Controller
{

    public function __construct(private GiftService $giftService)
    {
    }

    public function index(Request $request)
    {
        if ($request->pjax()) {
            return view('admin.gifts.products.table', [
                'gift_products' => $this->giftService->getGiftProducts()
            ]);
        }

        return view('admin.gifts.index', [
            'gift_products' => $this->giftService->getGiftProducts(),
            'gift_conditions' => $this->giftService->getGiftConditions(),
            'brands' => Brand::all(),
            'categories' => Category::all(),
            'products' => Product::all()
        ]);
    }

}
