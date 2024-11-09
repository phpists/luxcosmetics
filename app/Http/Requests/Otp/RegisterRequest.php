<?php

namespace App\Http\Requests\Otp;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'unique:users,phone'],
            'birthday.day' => ['nullable', 'date_format:d'],
            'birthday.month' => ['nullable', 'date_format:m'],
            'birthday.year' => ['nullable', 'date_format:Y'],
            'newsletter' => ['nullable', 'bool'],
            'agreement' => ['required', 'bool']
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'email' => 'Электронная почта',
            'phone' => 'Телефон',
            'birthday.day' => 'Дата рождения',
            'birthday.month' => 'Дата рождения',
            'birthday.year' => 'Дата рождения',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Пользователь с таким email`ом уже зарегистрирован',
            'phone.unique' => 'Пользователь с таким телефоном уже зарегистрирован',
        ];
    }
}
