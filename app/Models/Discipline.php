<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    public function wnpDisciplineSems()
    {
        return $this->hasMany(WnpDisciplineSem::class);
    }

    public function disciplineType()
    {
        return $this->belongsTo(DisciplineType::class);
    }
}
