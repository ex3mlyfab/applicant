<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssetPurchase extends Model
{

    protected $guarded = [];

    public function assetModel(): BelongsTo
    {
        return $this->belongsTo(AssetModel::class);
    }
}
