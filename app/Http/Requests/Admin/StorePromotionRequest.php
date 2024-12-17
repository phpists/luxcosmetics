<?php

namespace App\Http\Requests\Admin;

use App\Models\Promotion;
use App\Services\Admin\PermissionService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class StorePromotionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return \Auth::user()->isSuperAdmin() || \Auth::user()->can(PermissionService::PROMOTIONS_CREATE);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'preview_img' => ['required', 'file'],
            'title' => ['required', 'string', 'max:255'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date', 'after_or_equal:starts_at'],
            'is_active' => ['boolean'],
            'short_description' => ['required', 'string'],
            'bg_img' => ['nullable', 'file'],
            'content' => ['required', 'string'],
            'btn_title' => ['nullable', 'string', 'max:255'],
            'btn_link' => ['nullable', 'string', 'max:255'],
            'products_title' => ['required', 'string', 'max:255'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
        ]);
    }

    public function handleFile(string $key): ?string
    {
        $file = $this->file($key);
        if ($file && Storage::disk('uploads')->put(Promotion::IMAGES_PATH, $file))
            return $file->hashName();

        return null;
    }
}
