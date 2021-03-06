<?php

namespace App\Http\Controllers\Voyager;

use App\Grade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return \Illuminate\Http\Response
   */
    public function index(Request $request)
    {
      if(isset($request->classroom_id)) {
        $check = DB::table('grades')->where('classroom_id', $request->classroom_id)->exists();

        if($check) {
          $data = DB::table('grades')
            ->join('students','grades.student_id', '=', 'students.id')
            ->select('grades.*', 'students.*')
            ->where('classroom_id', $request->classroom_id)
                  ->get();

          if(isset($request->type) && $request->type === 'THVP') {

            return view('vendor.grade', compact('data'));
          }
          return view('vendor.another', compact('data'));
        }

        return redirect()->route('voyager.dashboard');
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
        if($request->has('classroomId')) {
          foreach ($request->get('items') as $item) {
            Grade::where('classroom_id', $request->get('classroomId'))
                  ->where('student_id', $item['userId'])
                  ->update(['test_score' => json_encode($item['grades'])]);
          }
          return back()->with(['message' => "Lưu thành công", 'alert-type' => 'success']);
        }else {
          return back()->with(['message' => "Lưu không thành công", 'alert-type' => 'error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return view('vendor.grade');
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
    public function update(Request $request)
    {
      dd($request->all());
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
