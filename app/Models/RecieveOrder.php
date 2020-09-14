<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RecieveOrder extends Model
{
    protected $guarded = [];

    public function purchaseOrder(): HasOne
    {
        return $this->hasOne(PurchaseOrder::class);
    }
    public function purchaseOrderDetails(): HasMany
    {
        return $this->hasMany(PurchaseOrderDetail::class);
    }
}
