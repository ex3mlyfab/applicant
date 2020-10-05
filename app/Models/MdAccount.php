<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class MdAccount extends Model
{
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function mdAccountCovers(): HasMany
    {
        return $this->hasMany(MdAccountCover::class);
    }
    public function invoice(): MorphMany
    {
        return $this->morphMany(Invoice::class, 'invoiceable');
    }
}
