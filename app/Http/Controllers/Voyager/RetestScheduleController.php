<?php

namespace App\Http\Controllers\Voyager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RetestScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $user = Auth::user();
      if($user->hasRole('teacher')) {
        $data = DB::table('retest_schedules')
          ->join('classrooms', 'retest_schedules.classroom_id', '=', 'classrooms.id')
          ->join('teachers', 'retest_schedules.teacher_id', '=', 'teachers.id')
          ->join('rooms', 'retest_schedules.room_id', '=', 'rooms.id')
          ->select('retest_schedules.id',
            'retest_schedules.schedule_type',
            'classrooms.name as draft_title',
            'retest_schedules.start_time as start',
            'retest_schedules.end_time as end',
            'retest_schedules.weekdays as dow',
            'retest_schedules.start_day as dowstart',
            'retest_schedules.end_day as dowend',
            'retest_schedules.color as backgroundColor',
            'retest_schedules.color as borderColor',
            'teachers.name as teacher',
            'rooms.name as room',
            'classrooms.HP_id')
          ->where('teachers.user_id', $user->id)
          ->get();
        $data = $data->each(function ($item){
          $item->title = $item->HP_id.' - '. $item->draft_title;
        });

        $newData = $data->toJson();
        return view('vendor.voyager.calendar', compact('newData'));
      }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
