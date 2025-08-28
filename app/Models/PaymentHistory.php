<?php

namespace App\Models;

use App\Classes\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentHistory extends BaseModel
{
    //Relation Start
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
