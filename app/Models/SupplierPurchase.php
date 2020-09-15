<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupplierPurchase extends Model
{
    protected $guarded=[];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
