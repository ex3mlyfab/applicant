<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bed extends Model
{
    protected $guarded = [];

    public function bedType(): BelongsTo
    {
        return $this->belongsTo(BedType::class);
    }
    public function wardModel(): BelongsTo
    {
        return $this->belongsTo(WardModel::class);
    }
    public function getBedNoAttribute()
    {
        return sprintf("%04d", $this->id);
    }
    public function inpatient(): HasMany
    {
        return $this->hasMany(Inpatient::class);
    }
}
