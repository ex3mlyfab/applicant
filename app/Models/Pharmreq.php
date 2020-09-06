<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Illuminate\Database\Eloquent\Relations\MorphMany;

class Pharmreq extends Model
{
    protected $guarded = [];



    public function seen_by(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'seen_by');
    }
    public function pharmReq(): MorphMany
    {
        return $this->morphMany(ConsultTest::class, 'testable');
    }
    public function invoices(): MorphMany
    {
        return $this->morphMany(InvoiceItem::class, 'bill');
    }

    public function pharmreqDetails(): HasMany
    {
        return $this->hasMany(PharmreqDetail::class);
    }

    public function pharmacyBill(): HasOne
    {
        return $this->hasOne(PharmacyBill::class);
    }
}
