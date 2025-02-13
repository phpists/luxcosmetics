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
            'products.*.brand_title' => ['required', 'string'],
            'products.*.category_title' => ['required', 'string'],
            'products.*.code' => ['required', 'string'],
            'products.*.code_1c' => ['required', 'string'],
            'products.*.title' => ['required', 'string'],
            'products.*.description_1' => ['required', 'string'],
            'products.*.description_2' => ['nullable', 'string'],
            'products.*.description_3' => ['nullable', 'string'],
            'products.*.description_4' => ['nullable', 'string'],
//            'products.*.availability' => ['integer'],
            'products.*.storage_conditions' => ['nullable', 'string'],
            'products.*.allergy' => ['nullable', 'string'],
            'products.*.spyrt' => ['nullable', 'integer'],
            'products.*.expiry_date' => ['nullable', 'integer'],
            'products.*.country_products' => ['nullable', 'string'],
            'products.*.height_product' => ['nullable', 'integer'],
            'products.*.length_product' => ['nullable', 'integer'],
            'products.*.width_product' => ['nullable', 'integer'],
            'products.*.weight_product' => ['nullable', 'numeric'],
            // похожие
            'products.*.similar_products' => ['nullable', 'string'],
            // сопутствующие
            'products.*.related_products' => ['nullable', 'string'],
            'products.*.properties' => ['nullable', 'array'],
            'products.*.properties.*' => ['array'],
            'products.*.properties.*.property_id' => ['required', 'string'],
            'products.*.properties.*.property_value' => ['nullable', 'string'],
            'products.*.base_property' => ['nullable', 'string'],
            // модификации
            'products.*.variations' => ['nullable', 'string'],
//            'products.*.price' => ['nullable', 'numeric'],
//            'products.*.alias' => ['nullable', 'string'],
//            'products.*.status' => ['nullable', 'boolean'],
//            'products.*.old_price' => ['nullable', 'numeric'],
//            'products.*.base_property_title' => ['nullable', 'string'],
//            'products.*.size' => ['nullable', 'string'],
//            'products.*.discount' => ['nullable', 'integer'],
//            'products.*.points' => ['integer'],
//            'products.*.items_left' => ['required', 'integer'],
            'products.*.additional_categories' => ['nullable', 'array']
        ];
    }
}
