<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
  protected $guarded = [];

  public  function rooms() {
    return $this->belongsToMany(Room::class);
  }

  public  function teacher() {
    return $this->belongsTo(Teacher::class);
  }

  public function categories() {
    return $this->belongsToMany(Category::class);
  }

  public function classSchedule() {
    return $this->hasMany(ClassSchedule::class);
  }

}
