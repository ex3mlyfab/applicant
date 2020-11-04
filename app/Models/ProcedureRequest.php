<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class ProcedureRequest extends Model
{
    protected $guarded = [];

    public function inpatient(): BelongsTo
    {
        return $this->belongsTo(Inpatient::class);
    }

    public function requestBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'requested_by');
    }

    public function testable(): MorphOne
    {
        return $this->morphOne(EncounterTest::class, 'testable');
    }

}
