<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Charge extends Model
{
    //
    protected $guarded = [];

    public function chargeCategory(): BelongsTo
    {
        return $this->belongsTo(ChargeCategory::class);
    }
}
