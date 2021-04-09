<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
  protected $guarded = [];
  public  function classroom() {
    return $this->hasOne(Classroom::class);
  }
}
