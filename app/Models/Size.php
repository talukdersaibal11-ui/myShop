<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Size extends Model
{
    // Relation Start
    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }
}
