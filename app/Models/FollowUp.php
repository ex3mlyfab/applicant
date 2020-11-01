<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class FollowUp extends Model
{
    //
    protected $guarded = [];

    public function encounter(): BelongsTo
    {
        return $this->belongsTo(Encounter::class);
    }
    public function seenBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'seen_by');
    }
}
