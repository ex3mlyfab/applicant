<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientStatistic extends Model
{
    //
    protected $guarded = [];

    public function registrationType(): BelongsTo
    {
        return $this->belongsTo(RegistrationType::class);
    }
}
