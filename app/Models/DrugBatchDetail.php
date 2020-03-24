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
        return DrugBatchDetail::where('drug_model_id', $this->drug_id)->sum('available_quantity');
    }

    public function getBroughtForwardAttribute()
    {
        return DrugBatchDetail::where('drug_model_id', $this->drug_id)->where('id', '!=', $this->id)->sum('available_quantity');
    }
}
