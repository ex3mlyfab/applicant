<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Insurance extends Model
{
    //
    protected $guarded = [];

    public function insuranceCategory(): BelongsTo
    {
        return $this->belongsTo(InsuranceCategory::class);
    }
}
