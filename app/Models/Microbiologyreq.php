<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Microbiologyreq extends Model
{
    protected $guarded = [];

    public function clinicalAppointment(): BelongsTo
    {
        return $this->belongsTo(ClinicalAppointment::class);
    }

    public function testables(): MorphMany
    {
        return $this->morphMany(EncounterTest::class, 'testable');
    }
    public function invoices(): MorphMany
    {
        return $this->morphMany(InvoiceItem::class, 'bill');
    }

    public function microbiologyReport(): HasOne
    {
        return $this->hasOne(MicrobiologyReport::class);
    }
    public function encounter(): BelongsTo
    {
        return $this->belongsTo(Encounter::class);
    }
}
