<?php

namespace App\Http\Requests\Admin\HRM;

use Illuminate\Foundation\Http\FormRequest;

class StoreDesignationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2'],
        ];
    }
}
