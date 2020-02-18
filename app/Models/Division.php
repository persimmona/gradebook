<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
   protected $keyType = 'string';
    
   public $incrementing = false;

   public $timestamps = false;

   public function studyGroup()
   {
      return $this->hasMany('App\Models\StudyGroups','division_id','id'); 
   }

   public function divisionTypes()
   {
      return $this->belongsTo('App\Models\DivisionType','division_type_id'); 
   }

}
