<?php

namespace App\Models;

use App\Http\Controllers\Admin\Setting\InsurancePackage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InsuranceService extends Model
{
    //
    protected $guarded =[];

    public function insurancePackage(): BelongsTo
    {
        return $this->belongsTo(InsurancePackage::class, 'insurance_package_id');
    }
}
