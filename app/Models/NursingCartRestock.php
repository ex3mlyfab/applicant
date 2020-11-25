<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NursingCartRestock extends Model
{
    protected $guarded = [];

    public function cartRestockDetails(): HasMany
    {
        return $this->hasMany(CartRestockDetail::class);
    }

    public function generatedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'supplied_by');
    }
    public function recievedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'recieved_by');
    }
}
