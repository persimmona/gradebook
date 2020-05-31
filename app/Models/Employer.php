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
    protected $guard = 'employer';

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

    public function getRoleAttribute()
    {
        return "employer";
    }

    public function getShortNameAttribute()
    {
        return substr($this->first_name, 0,2). ".".substr($this->middle_name, 0,2).".";
    }

}
