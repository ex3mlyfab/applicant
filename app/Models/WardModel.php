<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WardModel extends Model
{
    protected $guarded = [];

    public function beds(): HasMany
    {
        return $this->hasMany(Bed::class);
    }

    public function floor(): BelongsTo
    {
        return $this->belongsTo(Floor::class);
    }
    public function getBedStatusAttribute()
    {
        return $this->beds->filter(function($item){
            return $item['status'] == 'occupied';
        })->count();
    }
    public function getUnoccupiedBedAttribute()
    {
        return $this->beds->filter(function($item){
            return $item['status'] != 'occupied';
        });
    }
}
