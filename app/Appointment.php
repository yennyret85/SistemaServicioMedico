<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Appointment extends Model
{

    protected $table = "appointments";

    protected $fillable = [
    	'patient_id', 'doctor_id', 'specialty_id', 'appointment_date', 'appointment_time', 'status',
    ];

    public function patient()
    {
        return $this->belongsTo('App\User', 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo('App\User', 'doctor_id');
    }

    public function specialty()
    {
        return $this->belongsTo('App\Specialty', 'specialty_id');
    }

    public function medicalrecord()
    {
        return $this->hasOne('App\MedicalRecord', 'appointment_id');
    }

}
