<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MdAccountCover extends Model
{
    protected $guarded= [];

    public function mdAccount(): BelongsTo
    {
        return $this->belongsTo(MdAccount::class);
    }
}
