<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    use Notifiable, HasRoles;

    protected $table= "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'idcard', 'sex', 'birtdate', 'phone', 'cellphone', 'address', 'email', 'password', 'specialty_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function specialty()
    {
        return $this->belongsTo('App\Specialty', 'specialty_id');
    }

    public function appointments_patient()
    {
        return $this->hasMany('App\Appointment', 'patient_id');
    }

    public function appointments_doctor()
    {
        return $this->hasMany('App\Appointment', 'doctor_id');
    }

    public function recipe()
    {
        return $this->hasMany('App\Recipe', 'recipe_id');
    }
}
