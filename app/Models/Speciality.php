<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
   protected $keyType = 'string';
    
   public $incrementing = false;

   public $timestamps = false;
  

   public function studyPrograms()
   {
    	return $this->hasMany('App\Models\StudyProgram'); 
   }

 /* 
   public function osvitaLevel()
   {
    	return $this->belongsTo('App\Models\OsvitaLevel'); 
   }
*/

}
