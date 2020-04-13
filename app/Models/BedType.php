<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BedType extends Model
{
    protected  $guarded = [];

    public function beds(): HasMany
    {
        return $this->hasMany(Bed::class);
    }
}
