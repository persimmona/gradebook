<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyGroup extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "study_groups"; //rename model!

    public function studyCards()
    {
        return $this->hasMany(StudyCard::class);
    }

    public function wnpTitles()
    {
        return $this->hasMany(WnpTitle::class);
    }
}
