<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RetestSchedule extends Model
{
    public function room() {
      return $this->belongsTo(Room::class);
    }
}
