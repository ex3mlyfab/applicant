<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Encounter extends Model
{
    //
    protected $guarded = [];

    public function encounterable(): MorphTo
    {
        return $this->morphTo();
    }

    public function bloodreqs(): HasMany
    {
        return $this->hasMany(Bloodreq::class);
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


    public function ultrasoundreqs(): HasMany
    {
        return $this->hasMany(Ultrasoundreq::class);
    }
    public function admits(): HasMany
    {
        return $this->hasMany(AdmitModel::class);
    }
    public function tcas(): HasMany
    {
        return $this->hasMany(Tca::class);
    }

    public function histopathologyreq(): HasMany
    {
        return $this->hasMany(Histopathologyreq::class);
    }
}
