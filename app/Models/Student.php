<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Student extends Authenticatable
{
    protected $fillable = ['login','password','is_registered'];
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
  
    public function studyCards()
    {
        return $this->hasMany(StudyCard::class);
    }
    public function studyGroups()
    {
        return $this->belongsToMany('App\Models\StudyGroup','study_cards','student_id','study_group_id');
    }

    public function studyPrograms()
    {
        return $this->belongsToMany('App\Models\StudyProgram','study_cards','student_id','study_program_id');
    }

    public function studyStates()
    {
        return $this->belongsToMany('App\Models\StudyState','study_cards','student_id','study_state_id');
    }

    public function getSemesters($studyGroup)
    {//включить сюда id?
        $wnpTitles =  $this->studyGroups()->find($studyGroup)->wnpTitles()->orderBy('study_year_id', 'DESC')->get();//оформить отдельную функцию?
        //id карточки будет параметром
        $wnpSemesters = new Collection();
        $currentData = $wnpTitles[0]->studyYear->currentData;
        foreach ($wnpTitles as $wnpTitle){
           if($wnpTitle->study_year_id===$currentData->current_study_year_id)
                $wnpSemesters = $wnpSemesters->merge($wnpTitle->wnpSemesters()->where('session_type_id', '<=',  $currentData->current_session_type_id)
                    ->orderBy('semester_id', 'DESC')->get());
            else
                $wnpSemesters = $wnpSemesters->merge($wnpTitle->wnpSemesters()->orderBy('semester_id', 'DESC')->get());
        }
        return $wnpSemesters;
    }

    public function getDisciplines($wnpSemester)
    {
        $disciplines = [];
        $wnpDisciplineSems = $wnpSemester->wnpDisciplineSems->all();
        foreach ($wnpDisciplineSems as $wnpDisciplineSem) {
            if (isset($wnpDisciplineSem->discipline))
                $disciplines[] = $wnpDisciplineSem->discipline;
        }
        return $disciplines;
    }

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
           $assWithGroup = [];
           $groups = $this->studyGroups;
           foreach ($groups as $group) {
            $div = $group->division;
            $spec =$group->studyProgram->speciality;
            $ass += [ $spec->speciality_name => $div->division_name];
            $assWithGroup[] = [$group, $ass];
           }
           return $assWithGroup;
    }
// количество специальностей
    public function getCountSpecialities()
    {
      return count($this->getSpecialities());
    }

}
