<?php

namespace App\Actions;

use Illuminate\Support\Facades\DB;
use TCG\Voyager\Actions\AbstractAction;

class MyAction extends AbstractAction
{
  public function getTitle()
  {
    return 'Nhập Điểm';
  }

  public function getIcon()
  {
    return 'voyager-plus';
  }

//  public function getPolicy()
//  {
//    return 'read';
//  }

  public function getAttributes()
  {
    return [
      'class' => 'btn btn-sm btn-primary pull-right',
    ];
  }

  public function getDefaultRoute()
  {
    $var = $this->getTypeofClassroom($this->data->classroom_id);
    $convert = array_shift($var);
    $firstArr = explode("_", $convert->HP_id)[0];
    return route('grade.index', array("classroom_id"=>$this->data->classroom_id, 'type'=> trim($firstArr)));
  }

  public function shouldActionDisplayOnDataType()
  {
    return $this->dataType->slug == 'grades';
  }

  private function getTypeofClassroom($classroom_id) {
    $HP = DB::table('classrooms')
      ->select('classrooms.HP_id')
      ->where('id', $classroom_id)->get();

    return $HP->toArray();

  }



}
