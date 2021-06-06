<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Document extends Model
{
  protected $fillable = ['name','filename'];

  public function getFilenameAttribute($value)
  {
    return Str::replaceArray('\\\\', ['/', '/'], $value);
  }
}
