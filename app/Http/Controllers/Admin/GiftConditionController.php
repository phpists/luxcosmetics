<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GiftCondition;
use App\Models\GiftConditionException;
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

        $category_exceptions = $data['except_categories'] ?? [];
        unset($data['except_categories']);
        $brand_exceptions = $data['except_brands'] ?? [];
        unset($data['except_brands']);
        $product_exceptions = $data['except_products'] ?? [];
        unset($data['except_products']);


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

            $giftCondition->conditionExceptions()->createmany(Arr::map($category_exceptions, function ($item) {
                return [
                    'type' => GiftConditionException::TYPE_CATEGORY,
                    'foreign_id' => $item
                ];
            }));
            $giftCondition->conditionExceptions()->createmany(Arr::map($brand_exceptions, function ($item) {
                return [
                    'type' => GiftConditionException::TYPE_BRAND,
                    'foreign_id' => $item
                ];
            }));
            $giftCondition->conditionExceptions()->createmany(Arr::map($product_exceptions, function ($item) {
                return [
                    'type' => GiftConditionException::TYPE_PRODUCT,
                    'foreign_id' => $item
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
        if ($request->wantsJson()) {
            $giftCondition->category_exceptions = $giftCondition->conditionExceptions()
                ->where('type', GiftConditionException::TYPE_CATEGORY)
                ->pluck('foreign_id');
            $giftCondition->brand_exceptions = $giftCondition->conditionExceptions()
                ->where('type', GiftConditionException::TYPE_BRAND)
                ->pluck('foreign_id');
            $giftCondition->product_exceptions = $giftCondition->conditionExceptions()
                ->where('type', GiftConditionException::TYPE_PRODUCT)
                ->pluck('foreign_id');
            return $giftCondition->load('conditionCases', 'conditionProducts');
        }

        return to_route('admin.gifts.index');
    }

    public function update(Request $request, GiftCondition $giftCondition)
    {
        $data = $request->post();

        $cases = $data['cases'] ?? [];
        unset($data['cases']);

        $products = $data['products'];
        unset($data['products']);

        $category_exceptions = $data['except_categories'] ?? [];
        unset($data['except_categories']);
        $brand_exceptions = $data['except_brands'] ?? [];
        unset($data['except_brands']);
        $product_exceptions = $data['except_products'] ?? [];
        unset($data['except_products']);

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

            $giftCondition->conditionExceptions()->delete();
            $giftCondition->conditionExceptions()->createmany(Arr::map($category_exceptions, function ($item) {
                return [
                    'type' => GiftConditionException::TYPE_CATEGORY,
                    'foreign_id' => $item
                ];
            }));
            $giftCondition->conditionExceptions()->createmany(Arr::map($brand_exceptions, function ($item) {
                return [
                    'type' => GiftConditionException::TYPE_BRAND,
                    'foreign_id' => $item
                ];
            }));
            $giftCondition->conditionExceptions()->createmany(Arr::map($product_exceptions, function ($item) {
                return [
                    'type' => GiftConditionException::TYPE_PRODUCT,
                    'foreign_id' => $item
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
