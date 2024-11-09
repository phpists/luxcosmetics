<?php

namespace App\Http\Requests\Otp;

use HiFolks\RandoPhp\Randomize;
use Illuminate\Foundation\Http\FormRequest;

class VerifyCodeRequest extends FormRequest
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
            'phone' => ['required', 'string'],
            'code' => ['required', ...$this->getCodeValidators()],
        ];
    }

    private function getCodeValidators(): array
    {
        $format = match (config('otp.format')) {
            'numeric' => 'numeric',
            'alphanumeric' => 'alpha_num:ascii',
            'alpha' => 'alpha:ascii',
        };

        $lengthNum = config('otp.length');
        $length = match ($format) {
            'numeric' => "digits:$lengthNum",
            'alphanumeric', 'alpha' => "size:$lengthNum",
        };

        return [$format, $length];
    }
}
