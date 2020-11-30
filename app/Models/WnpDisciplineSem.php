<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WnpDisciplineSem extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }

    public function wnpSemester()
    {
        return $this->belongsTo(WnpSemester::class);
    }
    public function wnpDiscSemEmployers()
    {
        return $this->hasMany(WnpDiscSemEmployer::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function studyType()
    {
        return $this->belongsTo(StudyType::class, 'finished_study_type_id');
    }

    public function testDisciplines()
    {
        return $this->hasMany(TestDiscipline::class)->orderBy('attestation_id');
    }
    public function getEmpTypeByEmployerId($employerId)
    {
        if(is_null($this->wnpDiscSemEmployers()->where('employer_id', $employerId)->first()))
            return 0;
        else
            return $this->wnpDiscSemEmployers()->where('employer_id', $employerId)->first()->emp_type_id;
    }

    public function getEmpType1()
    {
        return $this->wnpDiscSemEmployers()->where('emp_type_id', 1)->first();
    }
    public function getEmpType2()
    {
        return $this->wnpDiscSemEmployers()->where('emp_type_id', 2)->get();
    }

}
