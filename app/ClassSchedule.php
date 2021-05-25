<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
  public  function teacher() {
    return $this->belongsTo(Teacher::class);
  }

  public  function room() {
    return $this->belongsTo(Room::class);
  }
}
