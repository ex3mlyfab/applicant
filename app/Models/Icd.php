<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Icd extends Model
{
    //
    protected $guarded = [];

    public function icdCategory(): BelongsTo
    {
        return $this->belongsTo(IcdCategory::class);
    }

}
