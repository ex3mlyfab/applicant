<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tca extends Model
{
    protected $guarded = [];
    public function clinicalAppointment(): BelongsTo
    {
        return $this->belongsTo(ClinicalAppointment::class);
    }
}
