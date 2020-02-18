<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
   protected $keyType = 'string';
    
   public $incrementing = false;

   public $timestamps = false;

   public function students()
   {
    	return $this->belongsToMany('App\Models\Student'); 

   }
   /*
   public function studyGroups()
   {
    	return $this->hasMany('App\Models\StudyGroups'); 
   }*/
    
   public function speciality()
   {
    	return $this->belongsTo('App\Models\Speciality'); 
   }
}
