<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RecieveOrder extends Model
{
    protected $guarded = [];

    public function purchaseOrder(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
   public function recieveOrderDetails(): HasMany
   {
       return $this->hasMany(RecieveOrderDetail::class, 'receive_order_id');
   }
   public function admin(): BelongsTo
   {
       return $this->belongsTo(Admin::class, 'checked_by');
   }

   public function supplier(): BelongsTo
   {
       return $this->belongsTo(Supplier::class);
   }
}
