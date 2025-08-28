<?php

namespace App\Classes;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Mattiverse\Userstamps\Traits\Userstamps;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BaseModel extends Model
{
    use HasFactory, Userstamps, SoftDeletes;

    protected $guarded = ["id"];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function scopeActive($query): void
    {
        $query->where('status', 'active');
    }

    public function scopeInactive($query): void
    {
        $query->where('status', 'inactive');
    }

    // Generate slug
    protected function slug(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn (string $value) => Str::slug($value),
        );
    }

    public function getOldPath($imageName)
    {
        // Use pathinfo to extract the filename
        $pathInfo = pathinfo($imageName);

        // Get the filename from pathinfo
        $filename = $pathInfo['basename'];

        return public_path($this->path . '/' . $filename);
    }
}
