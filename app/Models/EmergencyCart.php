<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EmergencyCart extends Model
{
    //
    protected $guarded = [];

    public function drugModel(): BelongsTo
    {
        return $this->belongsTo(DrugModel::class);
    }

    public function emergencyCartBatches(): HasMany
    {
        return $this->hasMany(EmergencyCartBatch::class)->orderByDesc('created_at');
    }

    public function getAvailableAttribute()
    {

        return $this->emergencyCartBatches()->where('available_quantity', '>', 0)->sum('available_quantity');
    }
}
