<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'last_name', 'email', 'password', 'other_names', 'phone', 'age_at_reg',
        'dob', 'avatar', 'folder_number', 'occupation', 'marital_status', 'address', 'city', 'state', 'national_id', 'source', 'nok', 'nok_relationship', 'nok_phone', 'nok_address', 'registered_by', 'sex',


    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullNameAttribute()
    {
        return ucFirst($this->last_name) . ' ' . ucFirst($this->other_names);
    }

    public function getAgeAttribute()
    {
        if ($this->dob) {
            $dob = new Carbon($this->dob);
            return $dob->diffForHumans(null, true);
        } else {
            return $this->age_at_reg;
        }
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }
    public function clinicalAppointments(): HasMany
    {
        return $this->hasMany(ClinicalAppointment::class, 'patient_id');
    }

    public function vitalSigns(): HasMany
    {
        return $this->hasMany(VitalSign::class, 'patient_id');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'date',
    ];
}
