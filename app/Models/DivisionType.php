<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DivisionType extends Model
{
    public $timestamps = false;

    public function division()
   {
      return $this->hasMany('App\Models\Division','division_type_id','id'); 
   }
}
