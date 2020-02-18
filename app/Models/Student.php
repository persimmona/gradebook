<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Speciality;

class Student extends Model
{
    protected $keyType = 'string';
    
    public $incrementing = false;

    public $timestamps = false;
    
    public function studyGroups()
    {
  
    	return $this->belongsToMany('App\Models\StudyGroups','study_cards','student_id','study_group_id'); 
         
    }

    public function studyPrograms()
    {
    	
    	return $this->belongsToMany('App\Models\StudyProgram','study_cards','student_id','study_program_id'); 
    }
/*
    public function studyStates()
    {
    	return $this->belongsToMany('App\Models\StudyState','study_cards','student_id','study_state_id'); 
    }
*/
/*
    public function studyCard()
    {
        return $this->hasMany('App\Models\StudyCard','');
    }

*/

   // получаем массив где спец-й 1 и больше
    public function getSpecialities()
    {
         $specialities = array();
         $programs = $this->studyPrograms;
          if($programs->count()===1)
          {
            $specialities[] = $programs->first()->speciality;      
          }
          else {
            foreach ($programs as $program) {
                if(!in_array($program->speciality, $specialities))
                $specialities[]=$program->speciality;
              }
          } 
         return $specialities;     
    }

    // получаем факультеты по группе в которой находится студент

    public function getDivision()
    {
      $divisions=[];
      $stgroups = $this->studyGroups;
      foreach ($stgroups as $stgroup) {
        if(!in_array($stgroup->divisions, $divisions))
        $divisions[]=$stgroup->divisions;
      }
      return $divisions;
    }

// получаем асс-й масив название_спец => название факултета

    public function getAssSpecDivis()
    {
           $ass = [];
           $groups = $this->studyGroups;
           foreach ($groups as $group) {
            $div = $group->divisions;
            $spec =$group->studyProgram->speciality;
            $ass += [ $spec->speciality_name => $div->division_name];
           }
           return  $ass;
    }
// количество специальностей

    public function getCountSpecialities()
    {
      return count($this->getSpecialities());
    }


}
