<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConsultTest extends Model
{
    protected $guarded = [];
    public function consult(): BelongsTo
    {
        return $this->belongsTo(Consult::class);
    }
    public function pharmreqs(): HasMany
    {
        return $this->hasMany(Pharmreq::class);
    }

    public function haematologyreqs(): HasMany
    {
        return $this->hasMany(Haematologyreq::class);
    }

    public function microbiologyreqs(): HasMany
    {
        return $this->hasMany(Microbiologyreq::class);
    }

    public function radiologyreqs(): HasMany
    {
        return $this->hasMany(Radiologyreq::class);
    }
    public function bloodreqs(): HasMany
    {
        return $this->hasMany(Bloodreq::class);
    }

    public function ultrasoundreqs(): HasMany
    {
        return $this->hasMany(Ultrasoundreq::class);
    }
}
