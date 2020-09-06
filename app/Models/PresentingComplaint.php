<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PresentingComplaint extends Model
{
    protected $guarded = [];

    public function patientable(): MorphTo
    {
        return $this->morphTo();
    }
    public function consult(): HasOne
    {
        return $this->hasOne(Consult::class);
    }
}
