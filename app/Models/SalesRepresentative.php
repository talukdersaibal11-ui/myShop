<?php

namespace App\Models;

use App\Classes\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalesRepresentative extends BaseModel
{
    protected $uploadPath = "sr";

    public function godown(): BelongsTo
    {
        return $this->belongsTo(Godown::class, 'godown_code', 'code');
    }
}
