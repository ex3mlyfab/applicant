<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Insurance extends Model
{
    //
    protected $guarded = [];

    public function insuranceCategory(): BelongsTo
    {
        return $this->belongsTo(InsuranceCategory::class);
    }

    public function insurancePackages(): HasMany
    {
        return $this->hasMany(InsurancePackage::class);
    }
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
