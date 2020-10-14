<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class TreatmentSheet extends Model
{
    protected $guarded =[];
    public function inpatient(): BelongsTo
    {
        return $this->belongsTo(Inpatient::class);
    }
    public function encounter(): MorphOne
    {
        return $this->morphOne(Encounter::class, 'encounterable');

    }

    public function treatmentCharts(): HasMany
    {
        return $this->hasMany(TreatmentChart::class);
    }
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
}
