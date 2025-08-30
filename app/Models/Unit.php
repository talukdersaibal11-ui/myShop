<?php

namespace App\Models;

use App\Classes\BaseModel;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends BaseModel
{
    protected function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::title($value);
        $this->attributes['slug'] = Str::title($value, '-');
    }
    //Relation Start
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
