<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PharmreqDetail extends Model
{
    protected $guarded = [];

    public function drugModel(): BelongsTo
    {
        return $this->belongsTo(DrugModel::class);
    }
    public function pharmreq(): BelongsTo
    {
        return $this->belongsTo(Pharmreq::class);
    }
}
