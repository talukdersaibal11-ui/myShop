<?php

namespace App\Http\Requests\Admin\HRM;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeaveTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'              => ['required', 'string', 'min:2'],
            'max_days_per_year' => ['required', 'numeric']
        ];
    }
}
