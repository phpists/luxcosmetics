<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ProductsImportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'products' => ['required', 'array'],
            'products.*.title' => ['required', 'string'],
            'products.*.code' => ['required', 'string'],
            'products.*.price' => ['nullable', 'numeric'],
            'products.*.alias' => ['string'],
            'products.*.code_1c' => ['string'],
            'products.*.status' => ['boolean'],
            'products.*.old_price' => ['nullable', 'numeric'],
            'products.*.category_title' => ['required', 'string'],
            'products.*.base_property_title' => ['nullable', 'string'],
            'products.*.base_property' => ['required', 'string'],
            'products.*.brand_title' => ['required', 'string'],
            'products.*.description_1' => ['string'],
            'products.*.description_2' => ['string'],
            'products.*.description_3' => ['string'],
            'products.*.description_4' => ['string'],
            'products.*.availability' => ['integer'],
            'products.*.size' => ['string'],
            'products.*.discount' => ['nullable', 'integer'],
//            'products.*.points' => ['integer'],
            'products.*.length_product' => ['nullable', 'integer'],
            'products.*.width_product' => ['nullable', 'integer'],
            'products.*.height_product' => ['nullable', 'integer'],
            'products.*.weight_product' => ['nullable', 'numeric'],
            'products.*.country_products' => ['string'],
            'products.*.storage_conditions' => ['string'],
            'products.*.allergy' => ['string'],
            'products.*.spyrt' => ['integer'],
            'products.*.expiry_date' => ['integer'],
            'products.*.items_left' => ['required', 'integer'],

            'products.*.properties' => ['nullable', 'array'],
            'products.*.properties.*' => ['nullable', 'string'],
            // модификации
            'products.*.variations' => ['nullable', 'string'],
            // похожие
            'products.*.similar_products' => ['nullable', 'string'],
            // сопутствующие
            'products.*.related_products' => ['nullable', 'string'],
        ];
    }
}
