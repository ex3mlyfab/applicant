<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin  extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'username', 'password', 'email_verfied_at'
    ];

    protected $hidden = ['password'];
}
