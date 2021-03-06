<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
    public function nursingReports(): HasMany
    {
        return $this->hasMany(NursingReport::class)->orderByDesc('created_at');
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
    public function bed(): BelongsTo
    {
        return $this->belongsTo(Bed::class);
    }

    public function nursingPhysicalAssessments(): HasMany
    {
        return $this->hasMany(nursingPhysicalAssessment::class);
    }
    public function payments(): MorphMany
    {
        return $this->morphMany(PaymentReceipt::class, 'paymentable');
    }
    public function invoice(): MorphOne
    {
        return $this->morphOne(Invoice::class, 'invoiceable');
    }

    public function dischargeSummaries(): HasMany
    {
        return $this->hasMany(DischargeSummary::class);
    }

    public function getDoctorsDischargeAttribute()
    {
       return $this->dischargeSummaries->filter(function($item){
            return $item['professional'] == 'doctor';
       });
    }
    public function getNurseDischargeAttribute()
    {
       return $this->dischargeSummaries->filter(function($item){
            return $item['professional'] == 'nurse';
       });
    }
    public function inpatientBill(): HasOne
    {
        return $this->hasOne(InpatientBill::class);
    }

    public function procedureRequests(): HasMany
    {
        return $this->hasMany(ProcedureRequest::class);
    }
    public function fluidReports(): HasMany
    {
        return $this->hasMany(FluidReport::class);
    }

    public function clinicalTrackers(): HasMany
    {
        return $this->hasMany(ClinicalTracker::class)->orderBy('done');
    }

    public function fluidReportDetails(): HasManyThrough
    {
        return $this->hasManyThrough(FluidReportDetail::class, FluidReport::class);
    }

}
