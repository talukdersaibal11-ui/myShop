<?php

namespace App\Models;

use App\Classes\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends BaseModel
{
    //Relation Start
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);

    }
    public function statusHistories(): HasMany
    {
        return $this->hasMany(OrderStatusHistory::class);
    }

    public function paymentHistories(): HasMany
    {
        return $this->hasMany(PaymentHistory::class);
    }

    public function shippingHistories(): HasMany
    {
        return $this->hasMany(ShippingHistory::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
