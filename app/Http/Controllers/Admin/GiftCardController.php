<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GiftCard;
use App\Models\GiftCardValue;
use App\Services\FileService;
use App\Services\GiftCardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GiftCardController extends Controller
{

    public function __construct(private GiftCardService $giftCardService)
    {
    }

    public function index() {
        $giftCards = GiftCard::latest()->paginate();
        $colors = GiftCardValue::whereNotNull('color_card')->get();
        return view('admin.gift-cards.index', compact('giftCards', 'colors'));
    }

    public function store(Request $request)
    {
        $data = $request->post();

        if ($this->giftCardService->store($data))
            return back()->with('success', 'Подарочная карта создана и отправлена на почту получателю');
        else
            return back();
    }

    public function show(Request $request, GiftCard $giftCard)
    {
        if ($request->wantsJson())
            return new JsonResponse($giftCard);

        return back();
    }

    public function destroy(Request $request, GiftCard $giftCard) {
        $giftCard->delete();
        return redirect()->back()->with('success', 'Данные о подарочной карте успешно удалены из базы');
    }

}
