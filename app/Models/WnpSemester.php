<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class WnpSemester extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function wnpDisciplineSems()
    {
        return $this->hasMany(WnpDisciplineSem::class)->has('discipline');
    }

    public function sessionType()
    {
        return $this->belongsTo(SessionType::class);
    }

    public function wnpTitle()
    {
        return $this->belongsTo(WnpTitle::class);
    }
    public function disciplines()
    {
        return $this->belongsToMany(Discipline::class,'wnp_discipline_sems','wnp_semester_id','discipline_id');
    }


    public static function getSemesterById($termId)
    {
        return WnpSemester::where('id', $termId)->first();
    }
    public static function getAllSemestersByStudyGroup(StudyGroup $studyGroup)
    {
        $wnpTitles = $studyGroup->wnpTitles()->orderBy('study_year_id', 'DESC')->get();
        $wnpSemesters = new Collection();
        $currentData = CurrentData::first();
        foreach ($wnpTitles as $wnpTitle) {
            if ($wnpTitle->study_year_id === $currentData->current_study_year_id) {
                $wnpSemesters = $wnpSemesters->merge($wnpTitle->wnpSemesters()->where('session_type_id', '<=',  $currentData->current_session_type_id)->get());
            } else {
                $wnpSemesters = $wnpSemesters->merge($wnpTitle->wnpSemesters()->orderBy('semester_id', 'DESC')->get());
            }
        }
        return $wnpSemesters;
    }
}
