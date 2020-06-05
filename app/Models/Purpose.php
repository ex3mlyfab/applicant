<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Purpose extends Model
{
    protected $guarded = [];

    public function visitors(): HasMany
    {
        return $this->hasMany(Visitor::class);
    }
}
