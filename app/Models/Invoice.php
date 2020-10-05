<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Invoice extends Model
{
    protected $guarded = [];

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getBillingAttribute()
    {
        if (isset($this->user_id)) {
            return $this->user->full_name;
        }
    }
    public function invoiceItems(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function getTotalAmountAttribute()
    {
        return $this->invoiceItems->sum('amount');
    }
    public function pharmbills(): HasMany
    {
        return $this->hasMany(PharmacyBill::class);
    }
    public function invoiceable(): MorphTo
    {
        return $this->morphTo();
    }
}
