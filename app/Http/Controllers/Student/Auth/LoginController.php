<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  /**
   * Show the login form.
   *
   * @return \Illuminate\Http\Response
   */
  public function showLoginForm()
  {
    if(Auth::guard('student')->check()) {
      return redirect()
        ->intended(route('student.edit'));
    }
    return view('auth.login',[
      'title' => 'Học viên Đăng Nhập',
      'loginRoute' => 'student.login',
      'forgotPasswordRoute' => 'student.password.request',
    ]);
  }

  /**
   * Login the admin.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function login(Request $request)
  {
    $this->validator($request);
     $parameters = array_merge($request->only('email','password'), ['status' => 1]);

    if(Auth::guard('student')->attempt($parameters,$request->filled('remember'))){
      //Authentication passed...
      return redirect()
        ->intended(route('student.edit'))
        ->with('status','You are Logged in as Student!');
    }

    //Authentication failed...
    return $this->loginFailed();
  }

  /**
   * Logout the admin.
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  public function logout()
  {
    Auth::guard('student')->logout();
    return redirect()
      ->route('homepage')
      ->with('status','Student has been logged out!');
  }

  /**
   * Validate the form data.
   *
   * @param \Illuminate\Http\Request $request
   * @return
   */
  private function validator(Request $request)
  {
    //validation rules.
    $rules = [
      'email'    => 'required|email|min:5|max:191',
      'password' => 'required|string|min:4|max:255',
    ];

    //custom validation error messages.
//    $messages = [
//      'email.exists' => 'These credentials do not match our records.',
//    ];

    //validate the request.
    $request->validate($rules);
  }

  /**
   * Redirect back after a failed login.
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  private function loginFailed()
  {
    return redirect()
      ->back()
      ->withInput()
      ->with('error','Login failed, please try again!');
  }
}
