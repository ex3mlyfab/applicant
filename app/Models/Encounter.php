<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Encounter extends Model
{
    //
    protected $guarded = [];

    public function encounterable(): MorphTo
    {
        return $this->morphTo();
    }

    public function bloodreqs(): HasOne
    {
        return $this->hasOne(Bloodreq::class);
    }
    public function presentingComplaints(): HasOne
    {
        return $this->hasOne(PresentingComplaint::class);
    }

    public function physicalExams(): HasOne
    {
        return $this->hasOne(PhysicalExam::class);
    }

    public function followUps(): HasOne
    {
        return $this->hasOne(FollowUp::class);
    }

    public function pharmreqs(): HasOne
    {
        return $this->hasOne(Pharmreq::class);
    }

    public function haematologyreqs(): HasOne
    {
        return $this->hasOne(Haematologyreq::class);
    }

    public function microbiologyreqs(): HasOne
    {
        return $this->hasOne(Microbiologyreq::class);
    }

    public function radiologyreqs(): HasOne
    {
        return $this->hasOne(Radiologyreq::class);
    }


    public function ultrasoundreqs(): HasOne
    {
        return $this->hasOne(Ultrasoundreq::class);
    }
    public function admits(): HasOne
    {
        return $this->hasOne(AdmitModel::class);
    }
    public function tcas(): HasOne
    {
        return $this->hasOne(Tca::class);
    }

    public function histopathologyreq(): HasOne
    {
        return $this->hasOne(Histopathologyreq::class);
    }
}
