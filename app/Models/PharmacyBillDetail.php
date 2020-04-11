<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PharmacyBillDetail extends Model
{
    protected $guarded = [];

    public function pharmacyBill(): BelongsTo
    {
        return $this->belongsTo(PharmacyBill::class, 'pharmacybill_id');
    }
    public function drugModel(): BelongsTo
    {
        return $this->belongsTo(DrugModel::class);
    }
}
