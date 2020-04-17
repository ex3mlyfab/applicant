<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Floor extends Model
{
    protected $guarded = [];

    public function wardModel(): HasMany
    {
        return $this->hasMany(WardModel::class);
    }
}
