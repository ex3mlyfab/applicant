<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExpenseHead extends Model
{
    //
    protected $guarded = [];

    public function expense(): HasMany
    {
        return $this->hasMany(Expense::class);
    }
}
