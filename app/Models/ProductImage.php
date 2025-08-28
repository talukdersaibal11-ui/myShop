<?php

namespace App\Models;

use App\Classes\BaseModel;

class ProductImage extends BaseModel
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }
}
