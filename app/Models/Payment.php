<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Payment extends Model
{
    protected $guarded = [];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function invoiceItem(): BelongsTo
    {
        return $this->belongsTo(InvoiceItem::class);
    }
    public function invoices(): HasManyThrough
    {
        return $this->hasManyThrough(Invoice::class, InvoiceItem::class);
    }

    public function getBillingAttribute()
    {
        if (isset($this->user_id)) {
            return $this->user->full_name;
        } elseif (isset($this->name)) {
            return $this->name;
        }
    }
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
}
