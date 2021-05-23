<?php

namespace App\Http\Controllers\Student;

use App\Classroom;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderClassroom;
use App\ReExamination;
use Carbon\Carbon;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cartalyst\Stripe\Exception\CardErrorException;

class ReexaminationController extends Controller
{
    public function __construct() {
      $this->middleware('auth:student')->except('logout');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public  function index() {

      $user = auth()->user();
      $reExamination = ReExamination::where('student_id', '=', $user->id)->select('classroom_id')->get()->toArray();
      $data = DB::table('retest_schedules')
        ->join('grades', 'grades.classroom_id', '=', 'retest_schedules.classroom_id')
        ->join('classrooms', 'classrooms.id', '=', 'retest_schedules.classroom_id')
        ->select('grades.classroom_id as classroomId',
          'retest_schedules.start_registration_day',
          'retest_schedules.end_registration_day',
          'classrooms.HP_id as HP',
          'classrooms.name as roomName',
          'retest_schedules.start_day',
        )
        ->where('grades.student_id', $user->id)
        ->whereNotIn('retest_schedules.classroom_id', $reExamination)
        ->get();


      $newData = $data->filter(function ($item) {
        $nowDate =  Carbon::now();
        $startDate = Carbon::createFromFormat('Y-m-d',$item->start_registration_day);
        $endDate = Carbon::createFromFormat('Y-m-d',$item->end_registration_day);
        //dd($nowDate->between($startDate, $endDate));
        if($nowDate->between($startDate, $endDate)) {
          return $item;
        }
      });


      return view('student.re-examination',  compact('newData'));
    }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $classroom
   * @return \Illuminate\Http\Response
   */
    public function getData(Request $request, $classroom)
    {
      ///dd($classroom);
      $user = auth()->user();
      $data = DB::table('retest_schedules')
            ->join('grades', 'grades.classroom_id', '=', 'retest_schedules.classroom_id')
            ->join('classrooms', 'classrooms.id', '=', 'retest_schedules.classroom_id')
            ->select('grades.classroom_id as classroom',
              'classrooms.HP_id as HP',
              'classrooms.name as roomName',
              'retest_schedules.start_day',
              'retest_schedules.reexamination_fee as fee'
              )
            ->where('retest_schedules.classroom_id', $classroom)
            ->where('grades.student_id', $user->id)
            ->get();

      //dd($data);

      return response($data);

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
        $user = auth()->user();

      if($request->payment_types === 'onlinePayment') {

          try {
            $charge = $this->submitToStripe($request, $user);
            if(isset($charge) && !empty($charge)) {
              $order = $this->addToOrderTables($request, $user, null, 1);
              $this->addStudentToReExaminationTables($request, $user, $order);
              return back()->with('success_message', 'Đăng ký thành công');
            }
          }catch (CardErrorException $e) {
            $this->addToOrderTables($request, $user, $e->getMessage(), 0);
          return back()->withErrors('Error!'. $e->getMessage());
          }


        }elseif($request->payment_types === 'offlinePayment') {
          $order = $this->addToOrderTables($request, $user, null, 0);
          $this->addStudentToReExaminationTables($request, $user, $order);
          return back()->with('success_message', 'Đăng ký thành công');
        }
    }


  private function submitToStripe($request, $student) {
    $contents = Classroom::where('id', $request->classroom)->select('name')->get();
    $contents->map(function ($item){
      return $item->name;
    })->values()->toArray();

    $charge = Stripe::charges()->create([
      'amount' => $request->fee,
      'currency' => 'VND',
      'source' => $request->stripeToken,
      'description' => 'Order',
      'receipt_email' => $student->email,
      'metadata' => [
        'contents' => $contents
      ]
    ]);
    return $charge;
  }

  private function addToOrderTables($request, $student, $error, $status = 0) {
    $order = Order::create([
      'student_id' => isset($student) ? $student->id : null,
      'billing_fullname' => $student->fullname,
      'billing_id_card' => $student->id_card,
      'billing_email' => $student->email,
      'billing_address' => $student->address,
      'billing_phone' => $student->phone,
      'billing_selected_object' => 'HVC',
      'payment_types' => $request->payment_types,
      'billing_name_on_card' => isset($request->name_on_card) ? $request->name_on_card : null,
      'billing_total' => $request->fee,
      'status' => $status,
      'note' => 'Đăng ký Thi Lại',
      'error' => $error
    ]);

    // Insert into order_product table
    OrderClassroom::create([
      'order_id' => $order->id,
      'classroom_id' => $request->classroom
    ]);

    return $order;
  }

  private function addStudentToReExaminationTables($request, $student, $order) {
      ReExamination::create([
        'classroom_id' => $request->classroom,
        'student_id' => $student->id,
        'order_id' => $order->id
      ]);
  }

    /**
     * Display the specified resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
      $user = auth()->user();
      $data = DB::table('retest_schedules')
        ->join('re_examinations', 'retest_schedules.classroom_id', '=', 're_examinations.classroom_id')
        ->join('classrooms', 'retest_schedules.classroom_id', '=', 'classrooms.id')
        ->join('teachers', 'retest_schedules.teacher_id', '=', 'teachers.id')
        ->join('rooms', 'retest_schedules.room_id', '=', 'rooms.id')
        ->join('orders', 're_examinations.order_id', '=', 'orders.id')
        ->select('retest_schedules.id',
          'classrooms.name as title',
          'retest_schedules.start_time as start',
          'retest_schedules.end_time as end',
          'retest_schedules.weekdays as dow',
          'retest_schedules.start_day as dowstart',
          'retest_schedules.end_day as dowend',
          'retest_schedules.color as backgroundColor',
          'retest_schedules.color as borderColor',
          'teachers.name as teacher',
          'rooms.name as room',
          'classrooms.HP_id',
          'orders.status as orderStatus')
        ->where('orders.status', '1')
        ->where('re_examinations.student_id', $user->id)
        ->get();
      //'class_schedules.weekdays as dow',
      $newData = $data->toJson();
      //dd($newData);
      return view('student.re-examination-schedule', compact('newData'));
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
