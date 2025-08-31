<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GodownResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'slug'         => $this->slug,
            'code'         => $this->code,
            'manager'      => $this->manager,
            'phone_number' => $this->phone_number,
            'address'      => $this->address,
            'prefix'       => $this->prefix,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
        ];
    }
}
