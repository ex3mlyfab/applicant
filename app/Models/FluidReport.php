<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FluidReport extends Model
{
    //
    protected $guarded = [];

    public function inpatient(): BelongsTo
    {
        return $this->belongsTo(Inpatient::class);
    }

    public function fluidReportDetails(): HasMany
    {
        return $this->hasMany(FluidReportDetail::class);
    }
}
