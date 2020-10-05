<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecieveOrderDetail extends Model
{
    //
    protected $guarded =[];

    public function recieveOrder(): BelongsTo
    {
        return $this->belongsTo(RecieveOrder::class, 'receive_order_id' );
    }

    public function drugModel(): BelongsTo
    {
        return $this->belongsTo(DrugModel::class);
    }
}
