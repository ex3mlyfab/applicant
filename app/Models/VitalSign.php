<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VitalSign extends Model
{
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
    public function doneBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'done_by');
    }
}
