<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employer extends Authenticatable
{
    protected $fillable = ['login','password','is_registered'];
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function wnpDiscSemEmployers()
    {
        return $this->hasMany(WnpDiscSemEmployer::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }

    public function getSemesters()
    {
        $wnpDiscSemEmployers = $this->wnpDiscSemEmployers;
//        foreach ($wnpDiscSemEmployers as $wnpDiscSemEmployer)
//        $wnpSemesters = new Collection();
        $currentData = CurrentData::first();
        dd($currentData);
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
