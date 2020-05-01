<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class InpatientDetail extends Model
{
    protected $guarded = [];

    public function inpatient(): BelongsTo
    {
        return $this->belongsTo(Inpatient::class);
    }

    public function inlabtest(): MorphTo
    {
        return $this->morphTo();
    }
}
