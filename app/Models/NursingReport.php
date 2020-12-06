<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NursingReport extends Model
{
    //
    protected $guarded = [];

    public function inpatient(): BelongsTo
    {
        return $this->belongsTo(Inpatient::class);
    }
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'written_by');
    }

}
