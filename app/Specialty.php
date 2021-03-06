<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{

	protected $table = "specialties";

    protected $fillable = [
        'name',
    ];

    public function user()
    {
        return $this->hasMany('App\User', 'user_id');
    }

    public function appointment()
    {
        return $this->hasMany('App\Appointment', 'appointment_id');
    }
}

