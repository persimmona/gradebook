<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WnpSemester extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function wnpDisciplineSems()
    {
        return $this->hasMany(WnpDisciplineSem::class);
    }

    public function sessionType()
    {
        return $this->belongsTo(SessionType::class);
    }

    public function wnpTitle()
    {
        return $this->belongsTo(WnpTitle::class);
    }
}
