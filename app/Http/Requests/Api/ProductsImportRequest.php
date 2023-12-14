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
            'products.*.alias' => ['nullable', 'string'],
            'products.*.code_1c' => ['required', 'string'],
            'products.*.status' => ['nullable', 'boolean'],
            'products.*.old_price' => ['nullable', 'numeric'],
            'products.*.category_title' => ['required', 'string'],
//            'products.*.base_property_title' => ['nullable', 'string'],
            'products.*.base_property' => ['nullable', 'string'],
            'products.*.brand_title' => ['required', 'string'],
            'products.*.description_1' => ['required', 'string'],
            'products.*.description_2' => ['nullable', 'string'],
            'products.*.description_3' => ['nullable', 'string'],
            'products.*.description_4' => ['nullable', 'string'],
//            'products.*.availability' => ['integer'],
            'products.*.size' => ['nullable', 'string'],
            'products.*.discount' => ['nullable', 'integer'],
//            'products.*.points' => ['integer'],
            'products.*.length_product' => ['required', 'integer'],
            'products.*.width_product' => ['required', 'integer'],
            'products.*.height_product' => ['required', 'integer'],
            'products.*.weight_product' => ['required', 'numeric'],
            'products.*.country_products' => ['required', 'string'],
            'products.*.storage_conditions' => ['nullable', 'string'],
            'products.*.allergy' => ['nullable', 'string'],
            'products.*.spyrt' => ['nullable', 'integer'],
            'products.*.expiry_date' => ['required', 'integer'],
            'products.*.items_left' => ['required', 'integer'],

            'products.*.properties' => ['nullable', 'array'],
            'products.*.properties.*' => ['array'],
            'products.*.properties.*.property_id' => ['required', 'string'],
            'products.*.properties.*.property_value' => ['required', 'string'],
            // модификации
            'products.*.variations' => ['nullable', 'string'],
            // похожие
            'products.*.similar_products' => ['nullable', 'string'],
            // сопутствующие
            'products.*.related_products' => ['nullable', 'string'],
        ];
    }
}
