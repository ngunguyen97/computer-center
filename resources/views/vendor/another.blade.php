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
    #another-grade {
      width: 100rem;
    }


  </style>
@endsection

@section('content')
  <div class="panel-body">
    <div class="table-responsive">
      <form action="{{ route('grade.store')}}" method="post" enctype="multipart/form-data">
        {{ method_field('POST') }}
        {{ csrf_field() }}
        <table id="another-grade" class="table table-bordered table-striped" cellpadding="2" cellspacing="0">
          <thead>

          <tr>
            <th rowspan="2">Mã số sinh viên</th>
            <th rowspan="2" style="width: 17%;">Họ và tên</th>
            <th rowspan="2" style="width: 15%;">Địa Chỉ</th>
            <th colspan="2" scope="colgroup" style="text-align: center; width: 10%;">Lý Thuyết</th>
            <th colspan="2" scope="colgroup" style="text-align: center;width: 10%;">Thực Hành</th>
            <th colspan="2" scope="colgroup" style="text-align: center;">Xếp Loại</th>
            <th colspan="2">Ghi Chú</th>
          </tr>
          <tr>
            <th scope="col">Lần 1</th>
            <th scope="col">Lần 2</th>
            <th scope="col">Lần 1</th>
            <th scope="col">Lần 2</th>
            <th scope="col">Lần 1</th>
            <th scope="col">Lần 2</th>
            <th scope="col">Lần 1</th>
            <th scope="col">Lần 2</th>
          </tr>
          </thead>
          <tbody>
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
                  @if($score_key === "classification" || $score_key === "note")
                    <td style="width: 25rem;">
                      <input type="text" name="items[{{$key}}][grades][{{$score_key}}][first_time]" min="0" max="10" value="{{$value["first_time"]}}" class="w-auto">
                    </td>
                    <td style="width: 25rem;">
                      <input type="text" name="items[{{$key}}][grades][{{$score_key}}][second_time]" min="0" max="10" value="{{$value["second_time"]}}" class="w-auto">
                    </td> <!-- Theory -->
                  @else
                    <td style="width: 25rem;">
                      <input type="number" name="items[{{$key}}][grades][{{$score_key}}][first_time]" min="0" max="10" value="{{$value["first_time"]}}" class="w-auto">
                    </td>
                    <td style="width: 25rem;">
                      <input type="number" name="items[{{$key}}][grades][{{$score_key}}][second_time]" min="0" max="10" value="{{$value["second_time"]}}" class="w-auto">
                    </td> <!-- Theory -->
                  @endif
                @endforeach
              @else

              <td style="width: 25rem;">
                <input type="number" name="items[{{$key}}][grades][theory][first_time]" min="0" max="10" value="" class="w-auto">
              </td>
              <td style="width: 25rem;">
                <input type="number" name="items[{{$key}}][grades][theory][second_time]" min="0" max="10" value="" class="w-auto">
              </td> <!-- Theory -->

              <td style="width: 25rem;">
                <input type="number" name="items[{{$key}}][grades][practice][first_time]" min="0" max="10" value="" class="w-auto">
              </td>
              <td style="width: 25rem;">
                <input type="number" name="items[{{$key}}][grades][practice][second_time]" min="0" max="10" value="" class="w-auto">
              </td> <!-- practice -->

              <td style="width: 25rem;">
                <input type="text" name="items[{{$key}}][grades][classification][first_time]"  value="" class="w-auto">
              </td>
              <td style="width: 25rem;">
                <input type="text" name="items[{{$key}}][grades][classification][second_time]" value="" class="w-auto">
              </td> <!-- classification -->

              <td style="width: 25rem;">
                <input type="text" name="items[{{$key}}][grades][note][first_time]" value="" class="w-auto">
              </td>
              <td style="width: 25rem;">
                <input type="text" name="items[{{$key}}][grades][note][second_time]" value="" class="w-auto">
              </td> <!-- Note -->
              @endif
            </tr>
          @endforeach
          </tbody>
        </table>
        <button type="submit" id="submitted-grade" class="btn btn-lg btn-success">Lưu</button>
      </form>
    </div>
  </div>

@endsection

@section('javascript')


@endsection
