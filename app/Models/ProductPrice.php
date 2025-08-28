<?php

namespace App\Models;

use App\Classes\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPrice extends BaseModel
{
    //Relation Start
    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class,'variant_id');
    }
}
