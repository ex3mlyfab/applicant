<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TheaterCartBatch extends Model
{
    protected $guarded = [];

    public function thearterCart(): BelongsTo
    {
        return $this->belongsTo(TheaterCart::class);
    }
}
