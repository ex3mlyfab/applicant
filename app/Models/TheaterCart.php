<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TheaterCart extends Model
{
    //
    protected $guarded = [];

    public function drugModel(): BelongsTo
    {
        return $this->belongsTo(DrugModel::class);
    }

    public function theaterCartBatches(): HasMany
    {
        return $this->hasMany(TheaterCartBatch::class)->orderByDesc('created_at');
    }

    public function getAvailableAttribute()
    {

        return $this->theaterCartBatches()->where('available_quantity', '>', 0)->sum('available_quantity');
    }
}
