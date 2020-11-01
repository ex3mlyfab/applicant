<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PaymentReceipt extends Model
{
    protected $guarded =[];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function paymentable(): MorphTo
    {
        return $this->morphTo();
    }
    public function getBillingAttribute()
    {
        if (isset($this->user_id)) {
            return $this->user->full_name;
        } elseif (isset($this->name)) {
            return $this->name;
        }
    }

}
