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
        return $this->belongsTo(StudyYear::class);
    }

}
