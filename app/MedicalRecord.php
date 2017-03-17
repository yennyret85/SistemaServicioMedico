<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    
    protected $table= "medicalrecords";
    
    protected $fillable = [
    	'appointment_id', 'reasonforappointment', 'physicalevaluation', 'medicalreport'
    ];

    public function appointment()
    {
        return $this->belongsTo('App\Appointment', 'appointment_id');
    }

    public function recipe()
    {
        return $this->hasOne('App\Recipe', 'medicalrecord_id');
    }    
}

