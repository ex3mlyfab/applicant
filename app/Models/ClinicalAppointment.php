<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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
        return $this->hasone(Consult::class, 'clinical_appointment_id');
    }

    public function payments(): MorphMany
    {
        return $this->morphMany(PaymentReceipt::class, 'paymentable');
    }




}
