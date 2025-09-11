<?php

namespace App\Http\Resources\Admin\HRM;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaveTypeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'max_days_per_year' => $this->max_days_per_year,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
            'createdBy'         => $this->whenLoaded('createdBy'),
            'updatedBy'         => $this->whenLoaded('updatedBy'),
        ];
    }
}
