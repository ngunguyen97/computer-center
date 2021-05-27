<?php

namespace App\Exports;


use App\ReExamination;
use App\RetestSchedule;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReExaminationExport implements FromView, ShouldAutoSize
{
    use Exportable;
    private $slug;
    public function __construct($slug) {
      $this->slug = $slug;
    }

  public function view(): View {
    $newData = ReExamination::with(
          'classroom',
                  'order', 'student',
                  'classroom.retestSchedule',
                  'classroom.retestSchedule.room',
              )
              ->get();

      $data = $newData->filter(function ($item, $key){
          if($item->classroom->HP_id === $this->slug && $item->order->status !== 0) {
            return $item;
          }
      });
      if($data->count() > 0) {
        return view('exports.re-examinations', [
          'dataTypeContent' => $data
        ]);
      }
    }
}
