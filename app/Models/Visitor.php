<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visitor extends Model
{
    protected $guarded = [];

    public function purpose(): BelongsTo
    {
        return $this->belongsTo(Purpose::class);
    }
    public function visitorName(): BelongsTo
    {
        return $this->belongsTo(VisitorName::class);
    }
}
