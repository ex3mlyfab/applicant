<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssetCategory extends Model
{
    protected $guarded = [];

    public function assetModels(): HasMany
    {
        return $this->hasMany(AssetModel::class);
    }
}
