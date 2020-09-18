<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class MicrobiologyReport extends Model
{
    protected $guarded = [];

    public function microbiologyreq(): BelongsTo
    {
        return $this->belongsTo(Microbiologyreq::class);
    }
    
}
