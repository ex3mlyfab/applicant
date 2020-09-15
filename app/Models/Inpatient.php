<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Inpatient extends Model
{
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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

    public function inpatientDetails(): HasMany
    {
        return $this->hasMany(InpatientDetail::class);
    }
}
