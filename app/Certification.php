<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
  protected $guarded = [];

  public  function classroom() {
    return $this->belongsTo(Classroom::class);
  }

  public  function student() {
    return $this->belongsTo(Student::class);
  }
}
