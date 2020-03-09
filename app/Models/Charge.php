<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Charge extends Model
{
    //
    protected $guarded = [];

    public function chargeCategory(): BelongsTo
    {
        return $this->belongsTo(ChargeCategory::class);
    }
    public function registrationTypes(): HasMany
    {
        return $this->hasMany(RegistrationType::class);
    }
}
