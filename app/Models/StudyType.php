<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyType extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function wnpDisciplineSems()
    {
        return $this->hasMany(WnpDisciplineSem::class);
    }

    public function testDisciplines()
    {
        return $this->hasMany(TestDiscipline::class);
    }

    public function studySubtype()
    {
        return $this->hasMany(StudySubtype::class);
    }


//    public static function getStudyTypesByDivisionId($divisionId)
//    {
//        return StudyType::where('division_id', $divisionId)->get();
//    }
}
