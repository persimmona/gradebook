<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrentData extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $primaryKey = 'current_study_year_id';

    public function sessionType()
    {
        return $this->belongsTo(SessionType::class, 'current_session_type_id');
    }
    public function studyYear()
    {
        return $this->belongsTo(StudyYear::class, 'current_study_year_id');
    }

    public static function getCurrentWeekNumber()
    {
        $startDate = CurrentData::first()->studyYear->year_date_start;
        $currentDate = date('Y-m-d');
        $first = date_create_from_format('Y-m-d', $startDate);
        $second = date_create_from_format('Y-m-d', $currentDate);
        return round($first->diff($second)->days/7);
    }

}
