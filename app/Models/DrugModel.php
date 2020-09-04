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
        return $this->belongsTo(DrugSubCategory::class);
    }
    public function drugBatchDetails(): HasMany
    {
        return $this->hasMany(DrugBatchDetail::class);
    }
    public function getAvailableAttribute()
    {
        // $price = DrugBatchDetail::where('pharmacy_id', $this->id)->orderBy('created_at', 'desc')->first();
        // return $price->available_quantity;

        return $this->drugBatchDetails->sum('available_quantity');
    }
    public function getPriceAttribute()
    {
        $item = $this->drugBatchDetails->last(function ($value, $key) {
            return $value->available_quantity > 0;
        });
        return $item->cost;
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
        return $this->hasMany(Pharmreq::class);
    }
    public function pharmacyBillDetails(): HasMany
    {
        return $this->hasMany(PharmacyBillDetail::class);
    }
}
