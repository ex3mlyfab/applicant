<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EnrollCharge extends Model
{
    //
    protected $guarded =[];

    public function enrollUser(): BelongsTo
    {
        return $this->belongsTo(EnrollUser::class);
    }
}
