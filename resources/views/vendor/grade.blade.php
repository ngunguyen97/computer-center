@extends('voyager::master')
@section('css')
  <style>
    .w-auto {
      width: 100% !important;
      border: none;
      background-color: transparent;
      padding-left: 10px;
    }
    .w-60 {
      width: 6rem;
    }
    .heading {
      width: 40%;
      font-weight: 600;
    }
    .cell-center {
      position: absolute;
      top: 30%;
      left: 30%;
      transform: translate(0, 50%);
    }
    .w-115 {
      width: 11.5rem;
    }
    #grades {
      width: 100rem;
    }


  </style>
@endsection

@section('content')
  Okay, THVP
  <div class="panel-body">
    <div class="table-responsive">
      <form action="{{ route('grade.store')}}" method="post" enctype="multipart/form-data">
      {{ method_field('POST') }}
      {{ csrf_field() }}
      <table id="grades" class="table table-bordered table-striped" cellpadding="2" cellspacing="0">
        <thead>
        <tr>
          <th rowspan="2">Mã số sinh viên</th>
          <th rowspan="2" >Họ và tên</th>
          <th rowspan="2" style="width: 15%;">Địa Chỉ</th>
          <th colspan="2" scope="colgroup" style="text-align: center;">Lý Thuyết</th>
          <th colspan="2" scope="colgroup" style="text-align: center;">Win_Word</th>
          <th colspan="2" scope="colgroup" style="text-align: center;">Excel</th>
          <th colspan="2" scope="colgroup" style="text-align: center;">Powerpoint</th>
          <th colspan="2" scope="colgroup" style="text-align: center;width: 14%;">Xếp Loại</th>
          <th colspan="2" scope="colgroup" style="text-align: center;width: 14%">Ghi Chú</th>
        </tr>
        <tr>
          @for($i = 0 ; $i < 6; $i++)
            <th scope="col" style="text-align: center;">Lần 1</th>
            <th scope="col" style="text-align: center;">Lần 2</th>
          @endfor
        </tr>
        </thead>
        <tbody>
        @if($data->count() > 0)
            @foreach($data as $key => $row)
              <tr>
                <td style="width: 120px;">
                  <span>{{ $row->id_card }}</span>
                  <input type="hidden" name="classroomId" value="{{ $row->classroom_id }}" class="w-auto">
                  <input type="hidden" name="items[{{$key}}][userId]" value="{{ $row->student_id }}" class="w-auto">
                </td>
                <td style="width: 20rem">
                  <span>{{ $row->fullname }}</span>
                </td>
                <td style="width: 25rem;"><span>{{ $row->address }}</span></td>

                @if(!empty($row->test_score))
                  @foreach(json_decode($row->test_score, true) as $score_key => $value)
                    <td class="w-60">
                      @if(!empty($value["first_time"]))
                        <input type="number" name="items[{{$key}}][grades][{{$score_key}}][first_time]" min="0" max="10" value="{{ $value["first_time"] }}" class="w-auto">
                      @else
                        <input type="number" name="items[{{$key}}][grades][{{$score_key}}][first_time]" min="0" max="10" value="" class="w-auto">
                      @endif
                    </td>
                    <td class="w-60">
                      @if(!empty($value["second_time"]))
                        <input type="number" name="items[{{$key}}][grades][{{$score_key}}][second_time]" min="0" max="10" value="{{ $value["second_time"] }}" class="w-auto">
                      @else
                        <input type="number" name="items[{{$key}}][grades][{{$score_key}}][second_time]" min="0" max="10" value="" class="w-auto">
                      @endif
                    </td>
                  @endforeach
                @else
                <td class="w-60">
                  <input type="number" name="items[{{$key}}][grades][theory][first_time]" min="0" max="10" value="" class="w-auto">
                </td>
                <td class="w-60">
                  <input type="number" name="items[{{$key}}][grades][theory][second_time]" min="0" max="10" value="" class="w-auto">
                </td> <!--theory -->
                <td class="w-60">
                  <input type="number" name="items[{{$key}}][grades][word][first_time]" min="0" max="10" value="" class="w-auto">
                </td>
                <td class="w-60">
                  <input type="number" name="items[{{$key}}][grades][word][second_time]" min="0" max="10" value="" class="w-auto">
                </td> <!--word -->
                <td class="w-60">
                  <input type="number" name="items[{{$key}}][grades][excel][first_time]" min="0" max="10" value="" class="w-auto">
                </td>
                <td class="w-60">
                  <input type="number" name="items[{{$key}}][grades][excel][second_time]" min="0" max="10" value="" class="w-auto">
                </td> <!--excel -->
                <td class="w-60">
                  <input type="number" name="items[{{$key}}][grades][powerpoint][first_time]" min="0" max="10" value="" class="w-auto">
                </td>
                <td class="w-60">
                  <input type="number" name="items[{{$key}}][grades][powerpoint][second_time]" min="0" max="10" value="" class="w-auto">
                </td> <!--powerpoint -->
                <td class="w-115">
                  <input type="text" name="items[{{$key}}][grades][classification][first_time]"  value="" class="w-auto">
                </td>
                <td class="w-115">
                  <input type="text" name="items[{{$key}}][grades][classification][second_time]" value="" class="w-auto">
                </td> <!--classification -->
                <td class="w-115">
                  <input type="text" name="items[{{$key}}][grades][note][first_time]" value="" class="w-auto">
                </td>
                <td class="w-115">
                  <input type="text" name="items[{{$key}}][grades][note][second_time]" value="" class="w-auto">
                </td>
                @endif
              </tr>
            @endforeach
         @endif
        </tbody>
      </table>
        <button type="submit" id="submitted-grades" class="btn btn-lg btn-success">Lưu</button>
      </form>
    </div>
  </div>
  {{--@foreach( $data as $item)--}}
    {{--{{ json_decode($item->test_score)->test_score }}--}}
  {{--@endforeach--}}

@endsection

@section('javascript')
@endsection
