<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SeoDataRequest extends FormRequest
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
            'data' => ['nullable', 'array'],
            'data.meta' => ['nullable', 'array'],
            'data.meta.*' => ['nullable', 'string'],
            'data.og' => ['nullable', 'array'],
            'data.og.*' => ['nullable', 'string'],
        ];
    }
}
