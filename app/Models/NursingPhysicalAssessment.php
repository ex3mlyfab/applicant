<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class NursingPhysicalAssessment extends Model
{
    //
    protected $guarded =[];
    public function encounter(): MorphOne
    {
        return $this->morphOne(Encounter::class, 'encounterable');

    }
    public function inpatient(): BelongsTo
    {
        return $this->belongsTo(Inpatient::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
}
