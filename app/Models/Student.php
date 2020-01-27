<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    /**
   * Связанная с моделью таблица.
   *
   * @var string
   */
   protected $table = 'students';

   public $incrementing = false;

   protected $keyType = 'string';

   /**
   * Откючает временные маркеры.
   *
   * @var bool
   */
   public $timestamps = false;

   /**
   * Атрибуты, для которых разрешено массовое назначение.
   *
   * @var array
   */
   protected $fillable = ['login','password','is_registered'];
}
