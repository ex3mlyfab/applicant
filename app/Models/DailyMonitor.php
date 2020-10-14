<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyMonitor extends Model
{
    protected $guarded= [];

    public function inpatient(): BelongsTo
    {
        return $this->belongsTo(Inpatient::class);
    }
}
