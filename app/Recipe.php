<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Recipe extends Model
{

    use SoftDeletes;

    protected $table= "recipes";

    protected $fillable = [
    	'status', 'pharmacist_id', 'medicalrecord_id', 'indications'
    ];

    public function medicine(){
    	return $this->bellongsToMany('App\Medicine', 'medicine_id');
    }

    public function pharmacist(){
    	return $this->bellongsTo('App\User', 'pharmacist_id');
    }

    public function medicalrecord(){
        return $this->bellongsTo('App\MedicalRecord', 'medicalrecord_id');
    }
    
}
