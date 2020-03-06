<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyCard extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function studyGroup()
    {
        return $this->belongsTo(StudyGroup::class);
    }

    public function testResults()
    {
        return $this->hasMany(TestResult::class, 'study_card_id');
    }

    public function getStudyCardById($id)
    {
        return $this->where('id', $id);
    }



}
