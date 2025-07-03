<?php

namespace App\Http\Requests\BestSeller;

use Illuminate\Foundation\Http\FormRequest;

class BestSellerStore extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image' => 'required',
            'title' => 'required',
            'description' => 'required',
            'link' => 'required'
        ];
    }
}
