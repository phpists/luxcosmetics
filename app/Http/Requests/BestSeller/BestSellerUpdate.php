<?php

namespace App\Http\Requests\BestSeller;

use Illuminate\Foundation\Http\FormRequest;

class BestSellerUpdate extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'link' => 'required'
        ];
    }
}
