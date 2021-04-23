<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
  /**
   * This will do all the heavy lifting
   * for resetting the password.
   */
  use ResetsPasswords;

  /**
   * Where to redirect users after resetting their password.
   *
   * @var string
   */
  protected $redirectTo = '/student/dashboard';

  /**
   * Only guests for "admin" guard are allowed except
   * for logout.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest:student');
  }

  /**
   * Show the reset password form.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  string|null  $token
   * @return \Illuminate\Http\Response
   */
  public function showResetForm(Request $request, $token = null){
    return view('auth.passwords.reset',[
      'title' => 'Reset Student Password',
      'passwordUpdateRoute' => 'student.password.update',
      'token' => $token,
    ]);
  }

  /**
   * Get the broker to be used during password reset.
   *
   * @return \Illuminate\Contracts\Auth\PasswordBroker
   */
  protected function broker(){
    return Password::broker('students');
  }

  /**
   * Get the guard to be used during password reset.
   *
   * @return \Illuminate\Contracts\Auth\StatefulGuard
   */
  protected function guard(){
    return Auth::guard('student');
  }
}
