<?php

namespace App\Models;

use App\Classes\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShippingHistory extends BaseModel
{
    //Relation Start
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    public function shippedBy(): BelongsTo
    {
        return $this->belongsTo(User::class,'shipped_by');
    }
}
