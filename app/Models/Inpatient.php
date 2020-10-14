<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Inpatient extends Model
{
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function treatmentSheets(): HasMany
    {
        return $this->hasMany(TreatmentSheet::class)->orderBy('continue');
    }

    public function encounter(): MorphOne
    {
        return $this->morphOne(Encounter::class, 'encounterable');

    }
    public function inpatientDetails(): HasMany
    {
        return $this->hasMany(InpatientDetail::class);
    }
    public function nursingHistoryTaking(): HasMany
    {
        return $this->hasMany(NursingHistoryTaking::class);
    }
    public function nursingFunctionalhp(): HasMany
    {
        return $this->hasMany(NursingFunctionalhp::class);
    }

    public function nursingPhysicalAssessments(): HasMany
    {
        return $this->hasMany(nursingPhysicalAssessment::class);
    }
    public function payments(): MorphMany
    {
        return $this->morphMany(PaymentReceipt::class, 'paymentable');
    }

}
