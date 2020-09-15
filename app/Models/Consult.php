<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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
    public function presentingComplaints(): MorphMany
    {
        return $this->morphMany(PresentingComplaint::class, 'patientable');
    }
    public function physicalExams(): MorphMany
    {
        return $this->morphMany(PhysicalExam::class, 'patientable');
    }
    public function followUps(): MorphMany
    {
        return $this->morphMany(FollowUp::class, 'patientable');
    }

   
}
