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
    protected $guard = 'student';

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

    public function getSemesters($studyCardId)
    {
        $wnpTitles = $this->studyCards()->find($studyCardId)->studyGroup->wnpTitles()->orderBy('study_year_id', 'DESC')->get();//оформить отдельную функцию?
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

}
