<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tca extends Model
{
    protected $guarded = [];


    public function encounter(): BelongsTo
    {
        return $this->belongsTo(Encounter::class);
    }
}
