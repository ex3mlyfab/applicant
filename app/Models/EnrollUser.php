<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class EnrollUser extends Model
{
    //
    protected $guarded = [];
    protected $appends = ['user_active'];

    public function insurancePackage(): BelongsTo
    {
        return $this->belongsTo(InsurancePackage::class, 'insurance_packages_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
    public function enrollCharges(): HasMany
    {
        return $this->hasMany(EnrollCharge::class);
    }
    public function activeEnrollments(): HasMany
    {
        return $this->hasMany(ActiveEnrollment::class);
    }
    public function getUserActiveAttribute()
    {
        // $active = $this->activeEnrollments->filter(function($item){
        //         $item->months == date('M');
        // });
        $active = $this->activeEnrollments->last()->months == date('M');
        return $active;
    }
}
