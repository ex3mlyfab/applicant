<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DischargeSummary extends Model
{
    protected $guarded =[];

    public function inpatient(): BelongsTo
    {
        return $this->belongsTo(Inpatient::class);
    }
    public function doneBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'done_by');
    }

}
