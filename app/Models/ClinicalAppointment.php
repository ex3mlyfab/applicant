<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function consult(): HasOne
    {
        return $this->hasone(Consult::class);
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
    // public function vitalsigns() : HasManyThrough
    // {
    //     return $this->hasManyThrough(VitalSign::class,
    //     User::class, )
    // }
}
