<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bank extends Model
{
    //
    protected $guarded = [];

    public function bankTransfers(): HasMany
    {
        return $this->hasMany(BankTransfer::class)->orderByDesc('created_at');
    }



}
