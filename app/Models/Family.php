<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Family extends Model
{
    protected $guarded = [];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'belongs_to');
    }
    public function registrationType(): BelongsTo
    {
        return $this->belongsTo(RegistrationType::class);
    }

    public function retainership(): HasOne
    {
        return $this->hasOne(Retainership::class);
    }
}
