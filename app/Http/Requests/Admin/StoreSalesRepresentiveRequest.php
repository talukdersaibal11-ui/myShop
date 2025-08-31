<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalesRepresentiveRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'         => ['required', 'string'],
            'email'        => ['nullable', 'email', 'unique:sales_representatives,email'],
            'phone_number' => ['required', 'unique:sales_representatives,phone_number'],
            'address'      => ['nullable'],
            'file'         => ['nullable', 'mimes:png,jpg,webp,jpeg', 'max:2048'],
        ];
    }
}
