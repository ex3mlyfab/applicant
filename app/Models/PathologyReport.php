<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PathologyReport extends Model
{
    protected $guarded = [];

    public function pathologyReq(): BelongsTo
    {
        return $this->belongsTo(Pathologyreq::class);
    }
    
}
