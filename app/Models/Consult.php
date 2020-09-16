<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Consult extends Model
{
    protected $guarded = [];

    public function clinicalAppointment(): BelongsTo
    {
        return $this->belongsTo(ClinicalAppointment::class, 'clinical_appointment_id');
    }

    public function consultTests(): HasMany
    {
        return $this->hasMany(ConsultTest::class);
    }
    public function encounter(): MorphOne
    {
        return $this->morphOne(Encounter::class, 'encounterable');

    }


}
