<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Medicine extends Model
{
    
    use SoftDeletes;

    protected $table = "medicines";

    protected $fillable = [
    	'name',
    ];

    public function recipe()
    {
        return $this->belongsToMany('App\Recipe', 'recipe_id');
    }
}
