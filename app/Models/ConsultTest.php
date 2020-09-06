<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ConsultTest extends Model
{
    protected $guarded = [];
    public function consult(): BelongsTo
    {
        return $this->belongsTo(Consult::class);
    }

    Public function followUp(): MorphOne
    {
        return $this->morphOne(FollowUp::class, 'patientable');
    }
    public function testable(): MorphTo
    {
        return $this->morphTo();
    }
}
