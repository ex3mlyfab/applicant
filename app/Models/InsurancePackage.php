<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class InsurancePackage extends Model
{
    //
    protected $guarded =[];
    public function insurance(): BelongsTo
    {
        return $this->belongsTo(Insurance::class);
    }

    public function insuranceServices(): HasMany
    {
        return $this->hasMany(InsuranceService::class, 'insurance_package_id');
    }

    public function enrollUsers(): HasMany
    {
        return $this->hasMany(EnrollUser::class, 'insurance_packages_id');
    }

    public function activeEnrollments(): HasManyThrough
    {
        return $this->hasManyThrough(ActiveEnrollment::class, EnrollUser::class);
    }

    public function invoice(): MorphMany
    {
        return $this->morphMany(Invoice::class, 'invoiceable');
    }

}
