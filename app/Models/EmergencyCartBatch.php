<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmergencyCartBatch extends Model
{
    protected $guarded = [];

    public function emergencyCart(): BelongsTo
    {
        return $this->belongsTo(EmergencyCart::class);
    }
}
