<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class EcgRequest extends Model
{
    //
    protected $guarded = [];

    public function labinfos(): MorphMany
    {
        return $this->morphMany(ConsultTest::class, 'labtest');
    }
    public function invoices(): MorphMany
    {
        return $this->morphMany(InvoiceItem::class, 'bill');
    }
}
