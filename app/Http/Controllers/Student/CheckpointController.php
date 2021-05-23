<?php

namespace App\Http\Controllers\Student;

use App\Grade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CheckpointController extends Controller
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
        return view('student.checkpoint');
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
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
    public function show($id)
    {
        $officeComputing = DB::table('grades')
          ->join('classrooms', 'grades.classroom_id','=', 'classrooms.id')
          ->select('grades.test_score','grades.student_id', 'classrooms.HP_id', 'classrooms.name')
          ->orWhere('classrooms.HP_id', 'like', '%THVP%')
          ->where('grades.student_id', $id);

        $anotherType = DB::table('grades')
          ->join('classrooms', 'grades.classroom_id','=', 'classrooms.id')
          ->select('grades.test_score','grades.student_id', 'classrooms.HP_id', 'classrooms.name')
          ->orWhere('classrooms.HP_id', 'NOT LIKE', '%THVP%')
          ->where('grades.student_id', $id);
      $anotherType = $anotherType->get();
      $officeComputing = $officeComputing->get();
      //dd($officeComputing);

      return view('student.checkpoint', compact('officeComputing', 'anotherType'));
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
