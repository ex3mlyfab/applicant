<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InsuranceCategory extends Model
{
    //
    protected $guarded = [];

    public function insurances(): HasMany
    {
        return $this->hasMany(Insurance::class);
    }
}
