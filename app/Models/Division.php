<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function wnpDisciplineSems()
    {
        return $this->hasMany(WnpDisciplineSem::class);
    }

    public function studyGroups()
    {
      return $this->hasMany('App\Models\StudyGroup','division_id','id');
    }

    public function divisionTypes()
    {
      return $this->belongsTo('App\Models\DivisionType','division_type_id');
    }

    public function employers()
    {
        return $this->hasMany(Employer::class,'division_id');
    }

    public static function getDivisionsByFaculty($facultyId) {
        return self::where('parent_division_id', $facultyId)->with('studyGroups')->get();
    }


}
