<?php

namespace App\Exports;

use App\Grade;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Http\Response;

class StudentExport  implements FromView, ShouldAutoSize
{
  use Exportable;
  private $slug;
  const DEFAULT_PASSSED = 5;
  public function __construct($slug) {
    $this->slug = $slug;
  }


  public function view(): View {
    $newData = Grade::with(
      'classroom', 'student',
      )
      ->get();


    $newData = $newData->filter(function ($item){
      return $item->classroom->HP_id === $this->slug;
    });

    $newData = $newData->filter(function($item) {
      $grade = json_decode($item->test_score);
      if(isset($grade->word)) {
        $theory_first = is_null($grade->theory->first_time) ? 0 : (int) $grade->theory->first_time;
        $word_first = is_null($grade->word->first_time) ? 0 : (int) $grade->word->first_time;
        $excel_first = is_null($grade->excel->first_time) ? 0 : (int) $grade->excel->first_time;
        $powerpoint_first = is_null($grade->powerpoint->first_time) ? 0 : (int) $grade->powerpoint->first_time;

        $theory_second = is_null($grade->theory->second_time) ? 0 : (int) $grade->theory->second_time;
        $word_second = is_null($grade->word->second_time) ? 0 : (int) $grade->word->second_time;
        $excel_second = is_null($grade->excel->second_time) ? 0 : (int) $grade->excel->second_time;
        $powerpoint_second = is_null($grade->powerpoint->second_time) ? 0 : (int) $grade->powerpoint->second_time;

        if(($theory_first >= self::DEFAULT_PASSSED
          && $word_first >= self::DEFAULT_PASSSED
          && $excel_first >= self::DEFAULT_PASSSED
          && $powerpoint_first >= self::DEFAULT_PASSSED)
          || ($theory_second >= self::DEFAULT_PASSSED
              && $word_second >=self::DEFAULT_PASSSED
              && $excel_second >=self::DEFAULT_PASSSED
              && $powerpoint_second >=self::DEFAULT_PASSSED)
        ) {
          return $item;
        }

      }else {
        $theory_first = is_null($grade->theory->first_time) ? 0 : (int) $grade->theory->first_time;
        $practice_first = is_null($grade->practice->first_time) ? 0 : (int) $grade->practice->first_time;
        $total_first = ($theory_first + $practice_first) / 2;

        $theory_second = is_null($grade->theory->second_time) ? 0 : (int) $grade->theory->second_time;
        $practice_second = is_null($grade->practice->second_time) ? 0 : (int) $grade->practice->second_time;
        $total_second = ($theory_second + $practice_second) / 2;

        if($total_first >= self::DEFAULT_PASSSED || $total_second >= self::DEFAULT_PASSSED) {
          return $item;
        }
      }

    });
    $data = $newData;
    if($data->count() > 0) {
      return view('exports.students.download', [
        'dataTypeContent' => $data
      ]);
    }else {
      return view('exports.students.download', [
        'dataTypeContent' => $data
      ]);
    }
  }
}
