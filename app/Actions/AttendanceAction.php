<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class AttendanceAction extends AbstractAction
{
  public function getTitle()
  {
    return 'Điểm Danh';
  }

  public function getIcon()
  {
    return 'voyager-eye';
  }



  public function getAttributes()
  {
    return [
      'class' => 'btn btn-sm btn-success pull-right',
    ];
  }

  public function getDefaultRoute()
  {
    return route('attendance.show', ['classroom' => $this->data->classroom_id]);
  }

  public function shouldActionDisplayOnDataType()
  {
    return $this->dataType->slug == 'grades';
  }
}
