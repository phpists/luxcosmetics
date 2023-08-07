<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GiftCard;
use App\Models\GiftCardValue;
use Illuminate\Http\Request;

class GifCardController extends Controller
{
    public function index()
    {
        $items = GiftCardValue::all();
        return view('admin.gif-card.index', compact('items'));
    }

    public function storeMinSum(Request $request)
    {
        $min_sum = $request->input('min_sum');
        $gif = GiftCardValue::first();

        if ($gif == null) {
            $gif = new GiftCardValue();
            $gif->min_sum = $min_sum;
            $gif->save();
        } else {
            $gif->min_sum = $min_sum;
            $gif->save();
        }
        return redirect()->back()->with('success', 'Сума успешно была изменина');
    }
    public function storeMaxSum(Request $request)
    {
        $max_sum = $request->input('max_sum');
        $gif = GiftCardValue::first();

        if ($gif == null) {
            $gif = new GiftCardValue();
            $gif->max_sum = $max_sum;
            $gif->save();
        } else {
            $gif->max_sum = $max_sum;
            $gif->save();
        }
        return redirect()->back()->with('success', 'Сума успешно была изменина');
    }

    public function storeFixPrice(Request $request)
    {
        $fix_price = $request->input('fix_price');
        $gif = GiftCardValue::pluck('fix_price')->first();
        if ($gif == null) {
            $gif = GiftCardValue::first();
            $gif->fix_price = $fix_price;
            $gif->save();
            return redirect()->back()->with('success', 'Вы успешно добавили новое значение');
        }
        $gif = new GiftCardValue();
        $gif->fix_price = $fix_price;
        $gif->save();

        return redirect()->back()->with('success', 'Вы успешно добавили новое значение');
    }
    public function updateFixPrice(Request $request, $id)
    {
        $number = $request->input('fix_price');
        $gif = GiftCardValue::find($id);
        $gif->fix_price = $number;
        $gif->save();

        return redirect()->back()->with('success', 'Вы успешно изменили значение');
    }
    public function deleteFixPrice(Request $request)
    {
        GiftCardValue::query()->where('id', $request->id)->delete();
        return redirect()->back()->with('success', 'Значения успешно удалено');
    }
    public function storeColorCard(Request $request)
    {
        $color_card = $request->input('color_card');
        $gif = GiftCardValue::whereNull('color_card')->first();

        if ($gif == null) {
            $gif = new GiftCardValue();
        }

        $gif->color_card = $color_card;
        $gif->save();

        if ($gif->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'Вы успешно добавили новое значение');
        } else {
            return redirect()->back()->with('success', 'Вы успешно обновили значение карты');
        }
    }
    public function deleteColorCard(Request $request)
    {
        $id = $request->id;
        $giftCard = GiftCardValue::find($id);
        if ($giftCard) {
            $giftCard->color_card = null;
            $giftCard->save();
            return redirect()->back()->with('success', 'Значение цвета карты успешно удалено.');
        } else {
            return redirect()->back()->with('error', 'Ошибка: объект с указанным id не найден.');
        }
    }
}
