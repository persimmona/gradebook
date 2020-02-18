<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyGroupState extends Model
{
   protected $keyType = 'decimal';
    
   public $incrementing = false;

   public $timestamps = false;
   
   public function studyGroups()
   {
    	return $this->hasMany('App\Models\StudyGroups'); 
   }
}
