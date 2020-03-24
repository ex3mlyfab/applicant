<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ConsultTest extends Model
{
    protected $guarded = [];
    public function consult(): BelongsTo
    {
        return $this->belongsTo(Consult::class);
    }

    public function labtest(): MorphTo
    {
        return $this->morphTo();
    }
}
