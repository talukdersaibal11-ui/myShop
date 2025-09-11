<?php

namespace App\Http\Resources\Admin\HRM;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'user_id'      => $this->user_id,
            'department'   => $this->department,
            'designation'  => $this->designation,
            'basic_salary' => $this->basic_salary,
            'nid'          => $this->nid,
            'join_date'    => $this->join_date,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
            'user'         => $this->whenLoaded('user'),
        ];
    }
}
