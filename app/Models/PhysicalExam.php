<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PhysicalExam extends Model
{
    protected $guarded = [];

    public function patientable(): MorphTo
    {
        return $this->morphTo();
    }
}
