<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SurgicalPatient extends Model
{
    protected $guarded = [];

    public function inpatient(): BelongsTo
    {
        return $this->belongsTo(Inpatient::class);
    }

    public function requestedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'requested_by');
    }
}
