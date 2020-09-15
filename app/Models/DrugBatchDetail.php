<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DrugBatchDetail extends Model
{
    //
    protected $guarded = [];

    public function drugModel(): BelongsTo
    {
        return $this->belongsTo(DrugModel::class);
    }

    public function getBalanceAttribute()
    {
        return $this->where('drug_model_id', $this->drugModel->id)->sum('available_quantity');
    }


}
