<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyType extends Model
{
    public $incrementing = false;
    protected $keyType = 'decimal';
    public $timestamps = false;

    public function wnpDisciplineSems()
    {
        return $this->hasMany(WnpDisciplineSem::class);
    }
}
