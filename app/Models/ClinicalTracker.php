<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClinicalTracker extends Model
{
    //
    protected $guarded = [];

    public function inpatient(): BelongsTo
    {
        return $this->belongsTo(Inpatient::class);
    }

    public function preparedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'prepared_by');
    }

    public function doneBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'done_by');
    }
}
