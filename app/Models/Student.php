<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $guarded = [];

    public function studyCards()
    {
        return $this->hasMany(StudyCard::class);
    }

    public function terms()
    {
        $wnpTitles =  $this->studyCards()->first()->studyGroup->wnpTitles->all();
        //id карточки будет параметром
        $terms = [];
        $currentData = $wnpTitles[0]->studyYear->currentData;
        foreach ($wnpTitles as $wnpTitle){
            $wnpSemesters = $wnpTitle->wnpSemesters;
            foreach ($wnpSemesters as $wnpSemester){
                $terms[$wnpSemester->semester_id] = $wnpTitle->study_year_id;
            }
        }
        krsort($terms);
        if(key($terms) % 2 + 1 > $currentData->current_session_type_id - 1) {
            reset($terms);
            $key = key($terms);
            unset($terms[$key]);
        }
        return $terms;
    }
}
