<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSalesRepresentiveRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'         => ['required', 'string'],
            'email'        => ['nullable', 'email'],
            'phone_number' => ['required'],
            'address'      => ['nullable'],
            'file'         => ['nullable', 'mimes:png,jpg,webp,jpeg', 'max:2048'],
        ];
    }
}
