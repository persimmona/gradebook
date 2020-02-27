<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class WnpSemester extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function wnpDisciplineSems()
    {
        return $this->hasMany(WnpDisciplineSem::class)->has('discipline');
    }

    public function sessionType()
    {
        return $this->belongsTo(SessionType::class);
    }

    public function wnpTitle()
    {
        return $this->belongsTo(WnpTitle::class);
    }

    public static function getSemesterById($termId)
    {
        return WnpSemester::where('id', $termId)->first();
    }
}
