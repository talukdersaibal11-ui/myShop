<?php

namespace App\Models;

use App\Classes\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends BaseModel
{
    //Relation Start

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class,'variant_id');
    }
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
