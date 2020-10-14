<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class TreatmentChart extends Model
{
    protected $guarded =[];
    public function encounter(): MorphOne
    {
        return $this->morphOne(Encounter::class, 'encounterable');

    }
    public function treatmentSheet(): BelongsTo
    {
        return $this->belongsTo(TreatmentSheet::class);
    }
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
}
