<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
  protected $attributes = [
    'author_id' => 4,
  ];

  public function getImageAttribute($value)
  {
    return Str::replaceArray('\\', ['/', '/'], $value);
  }

  public function getMetaDescriptionAttribute($value)
  {
    return Str::replaceArray('\\\\', ['/', '/'], $value);
  }
}
