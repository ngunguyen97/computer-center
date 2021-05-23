<?php

namespace App\Http\Controllers;

use App\Category;
use App\Classroom;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $rooms = Classroom::with('categories')
                      ->where('status', true)
                      ->get();
    $categories = Category::all();

    $rooms = $rooms->filter(function ($item) {
      $nowDate =  Carbon::now();
      $startDate = Carbon::createFromFormat('Y-m-d',$item->start_day);
      $endDate = Carbon::createFromFormat('Y-m-d',$item->end_day);
      //dd($nowDate->between($startDate, $endDate));
      if($nowDate->between($startDate, $endDate)) {
        return $item;
      }
    });

    return view('schedule')->with(compact('rooms', 'categories'));
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
