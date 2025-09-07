<?php

namespace App\Http\Requests\Admin\HRM;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'         => ['required', 'string', 'min:2'],
            'email'        => ['required', 'email', 'unique:users,email'],
            'phone_number' => ['min:11'],
            'file'         => ['nullable', 'mimes:png,jpg,webp,jpeg', 'max:2024']
        ];
    }
}
