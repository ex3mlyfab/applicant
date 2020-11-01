<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InpatientBillDetail extends Model
{
    protected $guarded = [];

    public function inpatientBill(): BelongsTo
    {
        return $this->belongsTo(InpatientBill::class);
    }
}
