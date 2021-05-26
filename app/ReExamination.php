<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReExamination extends Model
{
  protected $guarded = [];

  public function classroom() {
    return $this->belongsTo(Classroom::class);
  }

  public function order() {
    return $this->belongsTo(Order::class);
  }

  public  function student() {
    return $this->belongsTo(Student::class);
  }
}
