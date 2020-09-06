<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IcdCategory extends Model
{
    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo(Icd::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(IcdCategory::class, 'parent_id');
    }
    public function icds(): HasMany
    {
        return $this->hasMany(Icd::class);
    }

}
