<?php

namespace App\Models;

use App\Classes\BaseModel;
use Illuminate\Support\Str;

class Category extends BaseModel
{
    // Mutator for name
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::title($value);
        $this->attributes['slug'] = Str::slug($value);
    }
}
