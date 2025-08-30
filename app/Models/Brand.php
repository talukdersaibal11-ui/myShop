<?php

namespace App\Models;

use App\Classes\BaseModel;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends BaseModel
{
    public $path = "brands";

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::title($value);
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    // Relation Start
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
