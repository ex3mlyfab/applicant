<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Pharmreq extends Model
{
    protected $guarded = [];



    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'seen_by');
    }
    public function drugModel(): HasManyThrough
    {
        return $this->hasManyThrough(DrugModel::class, PharmreqDetail::class);
    }
    public function payments(): MorphMany
    {
        return $this->morphMany(PaymentReceipt::class, 'paymentable');
    }

    public function invoice(): MorphOne
    {
        return $this->morphOne(Invoice::class, 'invoiceable');
    }
    public function testable(): MorphOne
    {
        return $this->morphOne(EncounterTest::class, 'testable');
    }

    public function pharmreqDetails(): HasMany
    {
        return $this->hasMany(PharmreqDetail::class);
    }

    public function encounter(): BelongsTo
    {
        return $this->belongsTo(Encounter::class);
    }

    public function seenBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'seen_by');
    }
}
