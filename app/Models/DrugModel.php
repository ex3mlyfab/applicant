<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DrugModel extends Model
{
    protected $guarded = [];

    public function drugClass(): BelongsTo
    {
        return $this->belongsTo(DrugClass::class);
    }
    public function drugBatchDetails(): HasMany
    {
        return $this->hasMany(DrugBatchDetail::class)->orderByDesc('created_at');
    }
    public function getAvailableAttribute()
    {

        return $this->drugBatchDetails()->sum('available_quantity');
    }
    public function getPriceAttribute()
    {

        return $this->drugBatchDetails->first()->cost;
    }

    public function getBatchNoAttribute()
    {
        $item = $this->drugBatchDetails->first(function ($value, $key) {
            return $value->available_quantity > 0;
        });
        return $item->batch_no;
    }

    public function pharmreqDetails(): HasMany
    {
        return $this->hasMany(PharmreqDetail::class);
    }

}
