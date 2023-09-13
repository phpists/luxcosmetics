<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GiftCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class GiftConditionController extends Controller
{

    public function store(Request $request)
    {
        $data = $request->post();

        $cases = $data['cases'] ?? [];
        unset($data['cases']);

        $products = $data['products'];
        unset($data['products']);

        try {
            DB::beginTransaction();

            $giftCondition = GiftCondition::create($data);
            $giftCondition->conditionCases()->createMany(Arr::map($cases, function ($item) {
                return [
                    'foreign_id' => $item
                ];
            }));
            $giftCondition->conditionProducts()->createmany(Arr::map($products, function ($item) {
                return [
                    'gift_product_id' => $item
                ];
            }));

            DB::commit();

            return to_route('admin.gifts.index')->with('success', 'Условие для подарка успешно добавлено');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->withErrors(["ОШИБКА: {$exception->getMessage()}"]);
        }
    }

    public function show(Request $request, GiftCondition $giftCondition)
    {
        $giftCondition->update_url = route('admin.gift_conditions.update', $giftCondition);
        if ($request->wantsJson())
            return $giftCondition->load('conditionCases', 'conditionProducts');

        return to_route('admin.gifts.index');
    }

    public function update(Request $request, GiftCondition $giftCondition)
    {
        $data = $request->post();

        $cases = $data['cases'] ?? [];
        unset($data['cases']);

        $products = $data['products'];
        unset($data['products']);

        try {
            DB::beginTransaction();

            if (!$giftCondition->update($data))
                throw new \Exception('Ошибка!');

            $giftCondition->conditionCases()->delete();
            $giftCondition->conditionCases()->createMany(Arr::map($cases, function ($item) {
                return [
                    'foreign_id' => $item
                ];
            }));
            $giftCondition->conditionProducts()->delete();
            $giftCondition->conditionProducts()->createmany(Arr::map($products, function ($item) {
                return [
                    'gift_product_id' => $item
                ];
            }));

            DB::commit();
            return to_route('admin.gifts.index')->with('success', 'Условие для подарка успешно обновлено');
        } catch (\Exception $exception) {
            DB::rollBack();
            return to_route('admin.gifts.index')->withErrors(['Не удалось обновить условие для подарка']);
        }
    }

    public function destroy(Request $request, GiftCondition $giftCondition)
    {
        if ($giftCondition->delete())
            return back()->with('success', 'Условие для подарка удалено');

        return back()->withErrors(['Не удалось удалить условие для подарка']);
    }

}
