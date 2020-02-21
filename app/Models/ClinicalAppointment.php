<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class ClinicalAppointment extends Model
{
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    protected $dates = [
        'appointment_due',
    ];

    public function consults(): HasMany
    {
        return $this->hasMany(Consult::class);
    }

    public function presentingComplaints(): HasMany
    {
        return $this->hasMany(PresentingComplaint::class);
    }

    public function physicalExams(): HasMany
    {
        return $this->hasMany(PhysicalExam::class);
    }

    public function followUps(): HasMany
    {
        return $this->hasMany(FollowUp::class);
    }

    // public function vitalsigns() : HasManyThrough
    // {
    //     return $this->hasManyThrough(VitalSign::class,
    //     User::class, )
    // }
}
