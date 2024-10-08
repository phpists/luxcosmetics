<?php

namespace App\Http\Requests\Admin;

use App\Services\Admin\PermissionService;
use Illuminate\Foundation\Http\FormRequest;

class StorePromotionPropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return \Auth::user()->isSuperAdmin() || \Auth::user()->can(PermissionService::PROMOTIONS_EDIT);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'value' => ['required', 'string', 'max:255'],
        ];
    }
}
