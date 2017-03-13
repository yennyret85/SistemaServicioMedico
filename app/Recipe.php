<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected fillable = [
    	'status', 'pharmacist_id', 'medicine_id',
    ];

    public function medicine(){
    	return $this->bellongsToMany('App\Medicine', 'medicine_id');
    }

    public function medicalrecord(){
    	return $this->bellongsTo('App\MedicalRecord', 'medicalrecord_id');
    }

    public function pharmacist(){
    	return $this->bellongsTo('App\User', 'pharmacist_id');
    }


}
