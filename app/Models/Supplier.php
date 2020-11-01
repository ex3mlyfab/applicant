<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    protected $guarded = [];

    public function supplierPayables(): HasMany
    {
        return $this->hasMany(SupplierPayable::class);
    }
    public function supplierPurchases(): HasMany
    {
        return $this->hasMany(SupplierPurchase::class);
    }
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'checked_by');
    }

    public function recieveOrders(): HasMany
    {
        return $this->hasMany(RecieveOrder::class)->orderByDesc('created_at');
    }

}
