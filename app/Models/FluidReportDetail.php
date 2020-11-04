<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FluidReportDetail extends Model
{
    //
    protected $guarded = [];

    public function fluidReport(): BelongsTo
    {
        return $this->belongsTo(FluidReport::class);
    }

    public function doneBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'done_by');
    }
}
