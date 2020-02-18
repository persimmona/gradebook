<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyYear extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function wnpTitles()
    {
        return $this->hasMany(WnpTitle::class);
    }

    public function currentData()
    {
        return $this->hasOne(CurrentData::class, 'current_study_year_id');
    }
}
