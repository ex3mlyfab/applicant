<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PharmacyBill extends Model
{
    protected $guarded = [];

    public function pharmacyBillDetails(): HasMany
    {
        return $this->hasMany(PharmacyBillDetail::class, 'pharmacybill_id');
    }
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }
    public function pharmreq(): BelongsTo
    {
        return $this->belongsTo(Pharmreq::class);
    }
}
