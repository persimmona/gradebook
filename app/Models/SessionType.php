<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionType extends Model
{
    public $incrementing = false;
    protected $keyType = 'integer';
    public $timestamps = false;

    public function currentData()
    {
        return $this->hasOne(CurrentData::class, 'current_session_type_id');
    }

}
