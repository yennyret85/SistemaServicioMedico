<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;


use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use Notifiable, HasRoles;

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

    public function appointment()
    {
        return $this->hasMany('App\Appointment', 'appointment_id');
    }

    public function recipe()
    {
        return $this->hasMany('App\Recipe', 'recipe_id');
    }
    
}
