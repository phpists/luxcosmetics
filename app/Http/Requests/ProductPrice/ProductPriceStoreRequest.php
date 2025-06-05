<?php

namespace App\Http\Requests\ProductPrice;

use App\Models\ProductPrice;
use Illuminate\Foundation\Http\FormRequest;

class ProductPriceStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'is_active' => ['required'],
            'type' => ['sometimes'],
            'amount' => ['sometimes'],
            'rounding' => ['sometimes'],
            'start_date' => ['sometimes'],
            'end_date' => ['sometimes'],
            'cases' => ['sometimes'],
            'excepts' => ['sometimes']
        ];
    }

    public function withValidator($validator)
    {
        $productPrices = ProductPrice::leftJoin('product_price_cases', 'product_price_cases.product_price_id', '=', 'product_prices.id')
            ->leftJoin('product_price_exceptions', 'product_price_exceptions.product_price_id', '=', 'product_prices.id')
            ->whereNull('product_price_cases.product_price_id')
            ->whereNull('product_price_exceptions.product_price_id')
            ->first();

        $validator->after(function ($validator) use ($productPrices) {
            if (isset($productPrices)) {
                $validator->errors()->add('price', 'Модуль ценников на все товары уже существует: ' . $productPrices->title);
            }
        });
    }
}
