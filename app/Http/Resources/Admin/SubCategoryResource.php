<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'category_id' => $this->category_id,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
            'category'    => $this->whenLoaded('category')
        ];
    }
}
