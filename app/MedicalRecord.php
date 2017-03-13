<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MedicalRecord extends Model
{
    protected $fillable = [
    	'medical_record_date', 'patient_id', 'specialty_id', 'doctor_id', 'appointment_id', 'medical_report',
    ];

    public function specialty()
    {
        return $this->belongsTo('App\Specialty', 'specialty_id');
    }

    public function recipe()
    {
        return $this->hasOne('App\Recipe', 'recipe_id');
    }

    public function appointment()
    {
        return $this->belongsTo('App\Appointment', 'appointment_id');
    }
    
}

