<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $primaryKey = ['test_discipline_id', 'study_card_id'];
    public $incrementing = false;
    public $timestamps = false;

    public function studyCard()
    {
        return $this->belongsTo(StudyCard::class);
    }

    public function testDiscipline()
    {
        return $this->belongsTo(TestDiscipline::class, 'id', 'test_discipline_id');
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public static function getByStudyCardId(StudyCard $studyCard, TestDiscipline $testDiscipline)
    {
        return TestResult::where([['study_card_id', $studyCard->id], ['test_discipline_id', $testDiscipline->id]])->first();
    }


}
