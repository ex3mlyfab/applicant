<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DrugSubCategory extends Model
{
    protected $guarded = [];

    public function drugCategory(): BelongsTo
    {
        return $this->belongsTo(DrugCategory::class);
    }

    public function drugModels(): HasMany
    {
        return $this->hasMany(DrugModel::class);
    }
}
