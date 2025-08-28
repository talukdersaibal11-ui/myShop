<?php

namespace App\Models;

use App\Classes\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends BaseModel
{
    public $path = "brands";

    // Relation Start
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
