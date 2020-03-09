<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RegistrationType extends Model
{
    protected $guarded = [];

    public function charge(): BelongsTo
    {
        return $this->belongsTo(Charge::class);
    }

    public function families(): HasMany
    {
        return $this->hasMany(Family::class);
    }

    public function organization(): HasMany
    {
        return $this->hasMany(Organization::class);
    }
}
