<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    public function presentingComplaint(): BelongsTo
    {
        return $this->belongsTo(PresentingComplaint::class);
    }

    public function physicalExam(): BelongsTo
    {
        return $this->belongsTo(PhysicalExam::class);
    }

    public function followUp(): BelongsTo
    {
        return $this->belongsTo(FollowUp::class);
    }
}
