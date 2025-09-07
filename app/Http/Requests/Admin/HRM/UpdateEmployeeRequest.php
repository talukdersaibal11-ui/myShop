<?php

namespace App\Http\Requests\Admin\HRM;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'         => ['required', 'string'],
            'email'        => ['required', 'email'],
            'phone_number' => ['min:11'],
            'file'         => ['nullable', 'mimes:png,jpg,jpeg,webp', 'max:2024']
        ];
    }
}
