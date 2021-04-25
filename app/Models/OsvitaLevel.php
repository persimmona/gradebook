<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OsvitaLevel extends Model
{
   protected $keyType = 'decimal';

   public $incrementing = false;

    public $timestamps = false;
/*
    public function specialities()
    {
    	return $this->hasMany('App\Models\Speciality','osvita_level_id','id');
    }
    */
}
