<?php

namespace App\Http\Controllers\Student;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentCalendarController extends Controller
{
    public function __construct() {
      $this->middleware('auth:student')->except('logout');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $data = DB::table('class_schedules')
                ->join('grades', 'class_schedules.classroom_id', '=', 'grades.classroom_id')
                ->join('classrooms', 'class_schedules.classroom_id', '=', 'classrooms.id')
                ->join('teachers', 'class_schedules.teacher_id', '=', 'teachers.id')
                ->join('rooms', 'class_schedules.room_id', '=', 'rooms.id')
                ->select('class_schedules.id',
                  'classrooms.name as title',
                  'class_schedules.start_time as start',
                  'class_schedules.end_time as end',
                  'class_schedules.weekdays as dow',
                  'class_schedules.start_day as dowstart',
                  'class_schedules.end_day as dowend',
                  'class_schedules.color as backgroundColor',
                  'class_schedules.color as borderColor',
                  'teachers.name as teacher',
                  'rooms.name as room',
                  'classrooms.HP_id')
                ->where('grades.student_id', $user->id)
                ->get();

        //'class_schedules.weekdays as dow',
     $newData = $data->toJson();
     //dd($newData);
      return view('student.fullcalendar', compact('newData'));
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
