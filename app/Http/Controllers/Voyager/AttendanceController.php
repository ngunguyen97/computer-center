<?php

namespace App\Http\Controllers\Voyager;

use App\Attendance;
use App\Grade;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('grades')
          ->join('class_schedules', 'class_schedules.classroom_id', '=', 'grades.classroom_id')
          ->join('students', 'students.id', '=', 'grades.student_id')
          ->select('students.id_card as ID',
            'students.fullname',
            'class_schedules.start_day',
            'class_schedules.end_day',
            'class_schedules.weekdays')
          ->where('class_schedules.schedule_type', 'classSchedule')
          ->get();
      $data->map(function ($item){
        $item->schedules = $this->generateDateRange($item->start_day, $item->end_day, $item->weekdays);
      });
        //$data = $this->generateDateRange();
        dd($this->getDateRangeByClassroom(''));
    }

    private function getDateRangeByClassroom($classroom) {
      $data = DB::table('class_schedules')
        ->select(
          'class_schedules.start_day',
          'class_schedules.end_day',
          'class_schedules.weekdays')
        ->where('class_schedules.schedule_type', 'classSchedule')
        ->where('class_schedules.classroom_id', $classroom)
        ->get();
      $data->map(function ($item){
        $item->dateRange = $this->generateDateRange($item->start_day, $item->end_day, $item->weekdays);
      });
      return $data;
    }

    private function generateDateRange($from, $to , $days_of_week) {
      //dd(json_decode($days_of_week,true));
      $period = CarbonPeriod::create($from, $to);
      $days_of_week = json_decode($days_of_week,true);
      $result = [];
      setlocale(LC_ALL, 'vi');
      foreach ($period as $key => $date) {
        if (array_key_exists($date->dayOfWeek, $days_of_week)) {
          array_push($result, [
            'date' => $date->format('d/m/Y'),
            'day_name' => $date->shortLocaleDayOfWeek
          ]);

        }
      }
      return $result;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $students = DB::table('grades')
        ->join('class_schedules', 'class_schedules.classroom_id', '=', 'grades.classroom_id')
        ->join('students', 'students.id', '=', 'grades.student_id')
        ->select('students.id_card as ID_CARD',
          'students.id as userId',
          'students.fullname as fullName',
          'grades.attendance',
          'class_schedules.start_day',
          'class_schedules.end_day',
          'class_schedules.weekdays')
        ->where('grades.classroom_id', $id)
        ->where('class_schedules.schedule_type', 'classSchedule')
        ->get();
      $students->map(function ($item){
        $item->schedules = $this->generateDateRange($item->start_day, $item->end_day, $item->weekdays);
      });

      $classroom = DB::table('classrooms')
                  ->select('id as roomId', 'HP_id as HP', 'name as roomName')
                  ->where('id', $id)
                  ->get();

      $dates = $this->getDateRangeByClassroom($id);


      //dd($students);
      return view('vendor.voyager.grades.attendance', compact('dates', 'students', 'classroom'));
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
      //dd($request->items);
        foreach ($request->items as $item) {
          $record = $this->recordExsits($item['userId'], $id);
         // dd(json_encode($item['attendance']));
          if($record) {
            Grade::where('classroom_id', $id)
                      ->where('student_id', $item['userId'])
                      ->update(['attendance' => json_encode($item['attendance'])]);
          }
        }

      return back()->with(['message' => "Đã lưu thành công", 'alert-type' => 'success']);

    }

    private function recordExsits($studentId, $classroomId) {
      $record = DB::table('grades')
              ->where('classroom_id', $classroomId)
              ->where('student_id', $studentId)
              ->exists();

      return $record;
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
