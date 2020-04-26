<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudySubtype extends Model
{
    public $timestamps = false;

    public static function getByStudyTypeId($studyTypeId){
        return StudySubtype::where('study_type_id',$studyTypeId)->get();
    }
}
