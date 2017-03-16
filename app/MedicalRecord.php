<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MedicalRecord extends Model
{

    use SoftDeletes;
    
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

