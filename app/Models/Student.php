<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
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

    public function getSemesters()
    {//включить сюда id?
        $wnpTitles =  $this->studyCards()->first()->studyGroup->wnpTitles()->orderBy('study_year_id', 'DESC')->get();//оформить отдельную функцию?
        //id карточки будет параметром
        $wnpSemesters = new Collection();
        $currentData = $wnpTitles[0]->studyYear->currentData;
        foreach ($wnpTitles as $wnpTitle){
           if($wnpTitle->study_year_id===$currentData->current_study_year_id)
                $wnpSemesters = $wnpSemesters->merge($wnpTitle->wnpSemesters()->where('session_type_id', '<=',  $currentData->current_session_type_id)
                    ->orderBy('semester_id', 'DESC')->get());
            else
                $wnpSemesters = $wnpSemesters->merge($wnpTitle->wnpSemesters()->orderBy('semester_id', 'DESC')->get());

//            foreach ($wnpSemesters as $wnpSemester){
//                $terms[$wnpSemester->semester_id] = [$wnpTitle->study_year_id, $wnpSemester->id];
//
//            }
        }

//        krsort($terms);
//        if(key($terms) % 2 + 1 > $currentData->current_session_type_id - 1 && current($terms)==$currentData->current_study_year_id) {
//            reset($terms);
//            $key = key($terms);
//            unset($terms[$key]);
//        }
        return $wnpSemesters;
    }

    public function getDisciplines($wnpSemester)
    {
        //выходные параметры: Нужно вывести список дисциплин конкретного семестра, конкретной рабочей программы()!
       // $wnpTitles =  $this->studyCards()->first()->studyGroup->wnpTitles->all();
        //id карточки будет параметром
        $disciplines=[];
        //foreach ($wnpTitles as $wnpTitle){//скорее всего не подходит
           // $wnpSemester = $wnpTitle->wnpSemesters->find($termId);
            $wnpDisciplineSems = $wnpSemester->wnpDisciplineSems->all();//снова цикл? Это и есть наши предметы
            foreach ($wnpDisciplineSems as $wnpDisciplineSem)
            {
                if(isset($wnpDisciplineSem->discipline))
                    $disciplines[] = $wnpDisciplineSem->discipline;
            }
       // }
        return $disciplines;
    }



}
