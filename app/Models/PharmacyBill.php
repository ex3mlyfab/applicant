<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PharmacyBill extends Model
{
    protected $guarded = [];

    public function pharmacyBillDetails(): HasMany
    {
        return $this->hasMany(PharmacyBillDetail::class, 'pharmacybill_id');
    }
}
