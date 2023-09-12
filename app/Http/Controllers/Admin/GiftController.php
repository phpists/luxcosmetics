<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
            'conditions' => new Collection()
        ]);
    }

}
