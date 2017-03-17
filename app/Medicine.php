<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Medicine extends Model
{
    
    protected $table = "medicines";

    protected $fillable = [
    	'name',
    ];

    public function recipe()
    {
        return $this->belongsToMany('App\Recipe');
    }
}
