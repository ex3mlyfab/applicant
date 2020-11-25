<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class OperatingRoom extends Model
{
    protected $guarded = [];

    public function payments(): MorphMany
    {
        return $this->morphMany(PaymentReceipt::class, 'paymentable');
    }

    public function inpatient(): BelongsTo
    {
        return $this->belongsTo(Inpatient::class);
    }
    public function encounter(): BelongsTo
    {
        return $this->belongsTo(Encounter::class);
    }

}
