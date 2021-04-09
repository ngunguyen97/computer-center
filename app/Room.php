<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
  protected $guarded = [];
    public  function classrooms() {
      return $this->hasMany(Classroom::class);
    }
}
