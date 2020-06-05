<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisitorMessageCount extends Model
{
    //
    protected $guraded = [];
    public function visitorName(): BelongsTo
    {
        return $this->belongsTo(VisitorName::class);
    }

    public function messageTemplate(): BelongsTo
    {
        return $this->belongsTo(MessageTemplate::class);
    }
}
