<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyGroup extends Model
{
   protected $keyType = 'string';
    
   public $incrementing = false;

   public $timestamps = false;


   public function students()
   {
    	return $this->belongsToMany('App\Models\Student','study_cards','study_group_id','student_id'); 
    
   }
   
   public function division()
   {
      return $this->belongsTo('App\Models\Division','division_id'); 
   }

   public function studyProgram()
   {
   	    return $this->belongsTo('App\Models\StudyProgram'); 
   }

    public function wnpTitles()
    {
        return $this->hasMany(WnpTitle::class);
    }

/*

   public function educationForm()
   {
   	    return $this->belongsTo('App\Models\EducationForm'); 
   }

   public function studyGroupState()
   {
   	    return $this->belongsTo('App\Models\StudyGroupState'); 
   }
*/

}
