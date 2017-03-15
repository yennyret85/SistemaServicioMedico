<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Specialty extends Model
{

    use SoftDeletes;

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

