<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function studyType()
    {
        return $this->belongsTo(StudyType::class, 'finished_study_type_id');
    }
}
