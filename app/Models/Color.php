<?php

namespace App\Models;

use App\Classes\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Color extends BaseModel
{
    // Relation Start
    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }
}
