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
    $rooms = Category::with('classrooms')->get();
    $rooms = $rooms->filter(function($item) {
        $newItems = $item->classrooms;
        if($item->classrooms->count()) {
           $newItems = $newItems->filter(function($subItem) {
            $nowDate =  Carbon::now();
            $startDate = Carbon::createFromFormat('Y-m-d',$subItem->start_day);
            $endDate = Carbon::createFromFormat('Y-m-d',$subItem->end_day);
            if($nowDate->between($startDate, $endDate) && $subItem->status === 1) {
              return $subItem;
            }
          });
          if($newItems->count()) {
            return $item->newclassrooms = $newItems;
          }
        }
    });


    return view('schedule')->with(compact('rooms'));
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
