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
   public function studyGroup()
   {
      return $this->hasMany('App\Models\StudyGroup','division_id','id');
   }

   public function divisionTypes()
   {
      return $this->belongsTo('App\Models\DivisionType','division_type_id'); 
   }

}
