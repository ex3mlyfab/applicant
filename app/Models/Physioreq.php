<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Physioreq extends Model
{
    //
    protected $guarded = [];


    public function encounter(): BelongsTo
    {
        return $this->belongsTo(Encounter::class);
    }
    public function testables(): MorphMany
    {
        return $this->morphMany(EncounterTest::class, 'testable');
    }
}
