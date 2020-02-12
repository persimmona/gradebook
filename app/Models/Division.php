<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    public function wnpDisciplineSems()
    {
        return $this->hasMany(WnpDisciplineSem::class);
    }
}
