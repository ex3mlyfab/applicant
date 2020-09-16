<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PresentingComplaint extends Model
{
    protected $guarded = [];


    public function encounter(): BelongsTo
    {
        return $this->belongsTo(Encounter::class);
    }

}
