<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Bloodreq extends Model
{
    //
    protected $guarded = [];

    public function clinicalAppointment(): BelongsTo
    {
        return $this->belongsTo(ClinicalAppointment::class);
    }

    public function bloodRequests(): MorphMany
    {
        return $this->morphMany(ConsultTest::class, 'testable');
    }
    public function invoices(): MorphMany
    {
        return $this->morphMany(InvoiceItem::class, 'bill');
    }
}
