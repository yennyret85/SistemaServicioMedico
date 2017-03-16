<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Recipe extends Model
{

    use SoftDeletes;

    protected $fillable = [
    	'status', 'pharmacist_id', 'medicalrecord_id', 'indications'
    ];

    public function medicines(){
    	return $this->belongsToMany('App\Medicine', 'recipes_medicines');
    }

    public function pharmacist(){
    	return $this->belongsTo('App\User', 'pharmacist_id');
    }

    public function medicalrecord(){
        return $this->belongsTo('App\MedicalRecord', 'medicalrecord_id');
    }
    
}
