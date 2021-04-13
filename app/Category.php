<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $table = 'category';
  public function classrooms() {
    return $this->belongsToMany(Classroom::class);
  }
}
