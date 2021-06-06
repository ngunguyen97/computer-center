<?php

namespace App\Http\Controllers\Voyager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
  public function index() {
    $user = Auth::user();
    $data = DB::table('class_schedules')
      ->join('classrooms', 'class_schedules.classroom_id', '=', 'classrooms.id')
      ->join('teachers', 'class_schedules.teacher_id', '=', 'teachers.id')
      ->join('rooms', 'class_schedules.room_id', '=', 'rooms.id')
      ->select('class_schedules.id',
        'class_schedules.schedule_type',
        'classrooms.name as draft_title',
        'class_schedules.start_time as start',
        'class_schedules.end_time as end',
        'class_schedules.weekdays as dow',
        'class_schedules.start_day as dowstart',
        'class_schedules.end_day as dowend',
        'class_schedules.color as backgroundColor',
        'class_schedules.color as borderColor',
        'teachers.name as teacher',
        'rooms.name as room',
        'classrooms.HP_id'
        )
      ->where('teachers.user_id', $user->id)
      ->whereIn('class_schedules.classroom_id', function($query) {
        $query->select('classroom_id')->from('grades');
      })
      ->get();
    $data = $data->each(function ($item){
      $item->title = $item->HP_id.' - '. $item->draft_title;
    });

    //dd('hi', $data);
    $newData = $data->toJson();
    return view('vendor.voyager.calendar', compact('newData'));
  }
}
