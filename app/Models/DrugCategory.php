<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DrugCategory extends Model
{
    protected $guarded = [];

    public function drugSubCategories(): HasMany
    {
        return $this->hasMany(DrugSubCategory::class);
    }
}
