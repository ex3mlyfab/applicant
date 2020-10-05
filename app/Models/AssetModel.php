<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssetModel extends Model
{
    protected $guarded = [];

    public function assetCategory(): BelongsTo
    {
        return $this->belongsTo(AssetCategory::class);
    }

    public function assetAssigns(): HasMany
    {
        return $this->hasMany(AssetAssign::class);
    }

    public function assetPurchases(): HasMany
    {
        return $this->hasMany(AssetPurchase::class);
    }
    public function getAvailableAttribute()
    {
        // $price = DrugBatchDetail::where('pharmacy_id', $this->id)->orderBy('created_at', 'desc')->first();
        // return $price->available_quantity;

        return AssetPurchase::where('asset_model_id', $this->id)->sum('quantity');
    }
}
