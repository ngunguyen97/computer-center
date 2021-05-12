<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('welcome');
})->name('homepage');

Route::get('/lich-khai-giang', 'ScheduleController@index')->name('schedule.index');
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');
Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');

Route::get('/confirmation', 'ConfirmationController@index')->name('confirmation.index');

Route::get('/empty', function (){
  Cart::instance('default')->destroy();
});

use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationMail;
use Gloudemans\Shoppingcart\Facades\Cart;

Route::get('/email', function (){
  $product =  Cart::content()->map(function ($item) {
    return $item->model;
  });
  //dd($product);
  $object = (object) [
    'fullname' => 'Van Teo',
    'id_card' => '123456789',
    'address' => 'ABC Street',
    'phone' => '0356446995'
  ];
  Mail::to('email@email.com')->send(new ConfirmationMail($object, $product));
  return new \App\Mail\ConfirmationMail($object, $product);
});


//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin'], function () {

  Route::namespace('Voyager')->group(function() {

     Route::group(['middleware' => 'admin.user'], function () {
       Route::get('/add-grades', 'GradeController@index')->name('grade.index');
       Route::post('/add-grades', 'GradeController@store')->name('grade.store');
     });
   });
  Voyager::routes();
});

Route::get('/test-case', 'CheckoutController@addStudentToGradeTables');


Route::prefix('/student')->name('student.')->namespace('Student')->group(function () {
  Route::namespace('Auth')->group(function(){

    //Login Routes
    Route::get('/login','LoginController@showLoginForm')->name('login');
    Route::post('/login','LoginController@login');
    Route::post('/logout','LoginController@logout')->name('logout');

    //Forgot Password Routes
    Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');

    //Reset Password Routes
    Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');

  });

  Route::get('/my-profile','StudentController@edit')->name('edit');
  Route::PATCH('/my-profile', 'StudentController@update')->name('update');
  Route::get('/checkpoint/{user}','CheckpointController@show')->name('checkpoint.show');
});
