<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ProductsUpdateStocksRequest extends FormRequest
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
            'products.*.code' => ['required', 'string'],
            'products.*.items_left' => ['required', 'integer'],
//            'products.*.discount' => ['nullable', 'numeric'],
//            'products.*.price' => ['nullable', 'numeric'],
        ];
    }
}
