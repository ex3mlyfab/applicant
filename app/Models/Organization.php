<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Organization extends Model
{
    protected $guarded = [];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'organization_id');
    }

    public function registrationType(): BelongsTo
    {
        return $this->belongsTo(RegistrationType::class);
    }
    public function payments(): MorphOne
    {
        return $this->morphOne(PaymentReceipt::class, 'paymentable');
    }
    public function organizeable(): MorphTo
    {
        return $this->morphTo();
    }
}
