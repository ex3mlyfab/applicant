<?php

namespace App\Models;

use App\Traits\LockableTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Admin  extends Authenticatable
{
    use Notifiable, LockableTrait, HasRoles;

    protected $guard = 'admin';

    // protected $fillable = [
    //     'name', 'email', 'username', 'password', 'email_verfied_at'
    // ];
    protected $guarded = [];

    public function getFullNameAttribute()
    {
        return strtoupper($this->name . " " . $this->other_names);
    }

    public function pharmreqs(): HasMany
    {
        return $this->hasMany(Pharmreq::class, 'seen_by');
    }

    public function getUserNoAttribute()
    {
        return sprintf("%04d", $this->id);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    protected $hidden = ['password'];
}
