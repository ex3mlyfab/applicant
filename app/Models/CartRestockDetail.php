<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartRestockDetail extends Model
{
    //
    protected $guarded = [];

    public function nursingCartRestock(): BelongsTo
    {
        return $this->belongsTo(NursingCartRestock::class)->orderByDesc('created_at');
    }

    public function drugModel(): BelongsTo
    {
        return $this->belongsTo(DrugModel::class);
    }
}
