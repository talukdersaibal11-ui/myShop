<?php

namespace App\Http\Resources\Admin\HRM;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id'           => $request->id,
            'name'         => $request->name,
            'email'        => $request->email,
            'phone_number' => $request->phone_number,
            'role'         => $request->role,
            'status'       => $request->status,
            'created_at'   => $request->created_at,
            'updated_at'   => $request->updated_at,
            'employee'     => $this->whenLoaded('employee'),
        ];
    }
}
