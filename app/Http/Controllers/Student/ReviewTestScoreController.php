<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\ReviewTestScores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewTestScoreController extends Controller
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
      $classrooms = DB::table('grades')
                  ->join('classrooms', 'grades.classroom_id','=', 'classrooms.id')
                  ->select( 'classrooms.id','classrooms.HP_id', 'classrooms.name')
                  ->where('grades.student_id', $user->id)
                  ->get();
      //dd($classrooms);
      return view('student.review', compact('classrooms'));
    }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param $id
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(Request $request, $id)
  {
    $parameters = $request->only('classroom_id', 'content');
     $newItem = ReviewTestScores::create([
       'classroom_id' => $parameters['classroom_id'],
       'student_id' => $id,
       'content' => $parameters['content']
     ]);
     $newItem->save();

    return back()->with('success_message', 'Đã gửi phiếu phúc khảo thành công.');
  }
}
