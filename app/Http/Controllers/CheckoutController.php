<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Http\Requests\CheckoutRequest;
use App\Order;
use App\OrderClassroom;
use App\Student;
use App\User;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CheckoutController extends Controller
{
    const DEFAULT_PASSWORD = '123456789';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(empty(Cart::count())) {
          return redirect()->route('homepage');
        }
        return view('checkout');
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
   * @param \App\Http\Requests\CheckoutRequest $request
   *
   * @return \Illuminate\Http\Response
   */
    public function store(CheckoutRequest $request)
    {
      if($request->payment_types === 'onlinePayment') {
        try {
          $charge = $this->submitToStripe($request);
          if(isset($charge) && !empty($charge)) {
            $student = $this->exitsStudent($request) ? $this->exitsStudent($request) : $this->addStudentTables($request, 1);
            $this->addToOrderTables($request, $student, null, 1);
            $this->addStudentToGradeTables($student);
            Cart::instance('default')->destroy();
            return redirect()->route('confirmation.index')->with('success_message', 'Cảm ơn bạn! Thanh toán của bạn đã được chấp nhận thành công.');
          }

        }catch (CardErrorException $e) {
          $this->addToOrderTables($request, null, $e->getMessage(), 0);
          return back()->withErrors('Error!'. $e->getMessage());
        }
      }elseif($request->payment_types === 'offlinePayment') {
        $student = $this->exitsStudent($request) ? $this->exitsStudent($request) : $this->addStudentTables($request, 0);
        $this->addToOrderTables($request, $student, null, 0);
        $this->addStudentToGradeTables($student);
        Cart::instance('default')->destroy();
        return redirect()->route('confirmation.index')->with('checking_message_via_email', 'Cảm ơn. Quý khách vui lòng kiểm tra thông tin qua email.');
      }

    }

    private function submitToStripe($request) {
      $contents = Cart::content()->map(function($item){
        return $item->model->slug . ', '. $item->qty;
      })->values()->toJson();

      $amount = $this->getAmount();
      $charge = Stripe::charges()->create([
        'amount' => $amount,
        'currency' => 'VND',
        'source' => $request->stripeToken,
        'description' => 'Order',
        'receipt_email' => $request->email,
        'metadata' => [
          'contents' => $contents,
          'quantity' => Cart::instance('default')->count()
        ]
      ]);
      return $charge;
    }

    private function  getAmount() {
      return convertNumberFormatToInteger(Cart::total());
    }

    private function exitsStudent($request) {
      return Student::where('id_card', $request->id_card)->first();
    }

    private function addToOrderTables($request, $student, $error, $status = 0) {
      $order = Order::create([
        'student_id' => isset($student) ? $student->id : null,
        'billing_fullname' => $request->fullname,
        'billing_id_card' => $request->id_card,
        'billing_email' => $request->email,
        'billing_address' => $request->address,
        'billing_phone' => $request->phone,
        'billing_selected_object' => $request->selected_object,
        'payment_types' => $request->payment_types,
        'billing_name_on_card' => isset($request->name_on_card) ? $request->name_on_card : null,
        'billing_total' => $this->getAmount(),
        'status' => $status,
        'error' => $error
      ]);

      // Insert into order_product table
      foreach (Cart::content() as $item) {
        OrderClassroom::create([
          'order_id' => $order->id,
          'classroom_id' => $item->model->id
        ]);
      }
    }

    private function addStudentTables($request, $status = 0) {

      $student = Student::create([
        'fullname' => $request->fullname,
        'id_card' => $request->id_card,
        'email' => $request->email,
        'password' => Hash::make(self::DEFAULT_PASSWORD),
        'address' => $request->address,
        'phone' => $request->phone,
        'selected_object' => $request->selected_object,
        'status' => $status
      ]);
      return $student;
    }

    private function addStudentToGradeTables($student) {
      $studentId = $student->id;
      $classroom_id = $this->getClassroomId();
      $test_sore = $this->checkHPType();
      Grade::create([
        'classroom_id' => $classroom_id,
        'student_id' => $studentId,
        'attendance' => null,
        'test_score' => $test_sore
      ]);
    }

    private function checkHPType() {
      foreach (Cart::content() as $item) {
        $item->model->HP_id;
        if(str_contains($item->model->HP_id, 'THVP')) {
          return $this->GradeTHVPType();
        }else {
          return $this->GradeAnotherType();
        }
      }
    }

    private function getClassroomId() {
      $classroom = null;
      foreach (Cart::content() as $item) {
        $classroom = $item->model->id;
      }
      return $classroom;
    }

    private function GradeAnotherType() {
      $arrAnotherType = array(
        "classroom_id" => null,
        "student_id" => null,
        "grades" => [
          "theory" => [
            "first_time" => null,
            "second_time" => null,

          ],
          "practice" => [
            "first_time" => null,
            "second_time" => null,
          ],
          "classification" => [
            "first_time" => null,
            "second_time" => null
          ],
          "note" => [
            "value" => null
          ]
        ]
      );
      $arrAnotherType = json_encode($arrAnotherType);
      return $arrAnotherType;
    }

    private function GradeTHVPType() {
      $type = array(
        "classroom_id" => null,
        "student_id" => null,
        "grades" => [
          "theory" => [
            "first_time" => null,
            "second_time" => null,

          ],
          "practice" => [
            "word" => [
              "first_time" => null,
              "second_time" => null,
            ],
            "excel" => [
              "first_time" => null,
              "second_time" => null,
            ],
            "powerpoint" => [
              "first_time" => null,
              "second_time" => null,
            ]
          ],
          "classification" => [
            "first_time" => null,
            "second_time" => null
          ],
          "note" => [
            "value" => null
          ]
        ]
      );
      $type = json_encode($type);
      return $type;
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
