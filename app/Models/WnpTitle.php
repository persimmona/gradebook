<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WnpTitle extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function studyGroup()
    {
        return $this->belongsTo(StudyGroup::class);
    }
    public function studyYear()
    {
        return $this->belongsTo(StudyYear::class);
    }

    public function wnpSemesters()
    {
        return $this->hasMany(WnpSemester::class);
    }
}
