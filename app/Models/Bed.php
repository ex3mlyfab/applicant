<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bed extends Model
{
    protected $guarded = [];
    public function bedType(): BelongsTo
    {
        return $this->belongsTo(BedType::class);
    }
    public function wardModel(): BelongsTo
    {
        return $this->belongsTo(WardModel::class);
    }
}
