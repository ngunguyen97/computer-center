@extends('layout')

@section('title', 'Xem điểm')

@section('content')
  <div class="my-profile-section">
    <div class="products-section container-fluid">
      <div class="sidebar list-group list-group-flush">
        <ul>
          <li class="list-group-item"><a href="{{ route('student.edit') }}">Hồ sơ</a></li>
          <li class="list-group-item"><a href="#">Phiếu Đăng Ký</a></li>
          <li class="active list-group-item"><a href="{{ route('student.checkpoint.show', ['user' => Auth::guard('student')->user()->id ]) }}">Xem Điểm</a></li>
          <li class="list-group-item"><a href="{{ route('student.review.index') }}">Phúc Khảo</a></li>
        </ul>
      </div> <!-- End Sidebar -->

      <div class="my-checkpoint">
        <div class="show-grades">
          @if(!empty($officeComputing))
            <div class="THVP-grade-type">
              <table id="THVPtable" class="table table-bordered table-striped fs-14 text-center" cellpadding="2" cellspacing="0">
                <thead>
                <tr>
                  <th rowspan="2" style="position: relative;"><span class="th-table-center">Mã học phần</span></th>
                  <th rowspan="2" style="position: relative;"><span class="th-table-center">Tên khóa học</span></th>
                  <th colspan="2" scope="colgroup">Lý Thuyết</th>
                  <th colspan="2" scope="colgroup">Win_Word</th>
                  <th colspan="2" scope="colgroup">Excel</th>
                  <th colspan="2" scope="colgroup">Powerpoint</th>
                  <th colspan="2" scope="colgroup">Xếp Loại</th>
                  <th rowspan="2">Ghi Chú</th>
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
                  <th scope="col">Lần 1</th>
                  <th scope="col">Lần 2</th>
                </tr>
                </thead>
                <tbody>
                @foreach($officeComputing as $row)
                  @if(str_contains($row->HP_id, 'THVP'))
                    <tr class="text-center">
                      <td style="width: 160px">{{ $row->HP_id }}</td>
                      <td style="width: 180px;">{{ $row->name }}</td>

                      <td style="max-width: 30px;">
                        @if(isset($row->test_score))
                          {{ json_decode($row->test_score)->grades->theory->first_time }}
                        @endif
                      </td>
                      <td style="max-width: 30px;">
                        {{ json_decode($row->test_score)->grades->theory->second_time }}
                      </td> <!-- Ly Thuyet -->

                      <td style="max-width: 30px;">
                        {{ json_decode($row->test_score)->grades->practice->word->first_time }}
                      </td>
                      <td style="max-width: 30px;">
                        {{ json_decode($row->test_score)->grades->practice->word->second_time }}
                      </td> <!-- Word -->

                      <td style="max-width: 30px;">
                        {{ json_decode($row->test_score)->grades->practice->excel->first_time }}
                      </td>
                      <td style="max-width: 30px;">
                        {{ json_decode($row->test_score)->grades->practice->excel->second_time }}
                      </td> <!-- EXCEL -->

                      <td style="max-width: 30px;">
                        {{ json_decode($row->test_score)->grades->practice->powerpoint->first_time }}
                      </td>
                      <td style="max-width: 30px;">
                        {{ json_decode($row->test_score)->grades->practice->powerpoint->second_time }}
                      </td> <!-- PowerPoint -->

                      <td style="max-width: 30px;">
                        {{ json_decode($row->test_score)->grades->classification->first_time }}
                      </td>
                      <td style="max-width: 30px;">
                        {{ json_decode($row->test_score)->grades->classification->second_time }}
                      </td> <!-- XEP Loai -->

                      <td style="max-width: 60px;" >
                        {{ json_decode($row->test_score)->grades->note->value }}
                      </td> <!-- NOTE -->

                    </tr>

                  @endif
                @endforeach
                </tbody>
              </table>
            </div>
          @endif
            <div class="spacer"></div>
            @if(!empty($anotherType))
            <div class="another-grade-type">
              <table id="anotherGradeType" class="table table-bordered table-striped fs-14 text-center" cellpadding="2" cellspacing="0">
                <thead>
                <tr>
                  <th rowspan="2" style="position: relative;"><span class="th-table-center">Mã học phần</span></th>
                  <th rowspan="2" style="position: relative;"><span class="th-table-center">Tên khóa học</span></th>
                  <th colspan="2" scope="colgroup">Lý Thuyết</th>
                  <th colspan="2" scope="colgroup">Thực Hành</th>
                  <th colspan="2" scope="colgroup">Xếp Loại</th>
                  <th rowspan="2">Ghi Chú</th>
                </tr>
                <tr>
                  <th scope="col">Lần 1</th>
                  <th scope="col">Lần 2</th>
                  <th scope="col">Lần 1</th>
                  <th scope="col">Lần 2</th>
                  <th scope="col">Lần 1</th>
                  <th scope="col">Lần 2</th>
                </tr>
                </thead>
                <tbody>
                @foreach($anotherType as $row)
                    <tr class="text-center">
                      <td style="width: 160px">{{ $row->HP_id }}</td>
                      <td style="width: 180px;">{{ $row->name }}</td>

                      <td style="max-width: 30px;">
                        @if(isset($row->test_score))
                          {{ json_decode($row->test_score)->grades->theory->first_time }}
                        @endif
                      </td>
                      <td style="max-width: 30px;">
                        {{ json_decode($row->test_score)->grades->theory->second_time }}
                      </td> <!-- Ly Thuyet -->

                      <td style="max-width: 30px;">
                        {{ json_decode($row->test_score)->grades->practice->first_time }}
                      </td>
                      <td style="max-width: 30px;">
                        {{ json_decode($row->test_score)->grades->practice->second_time }}
                      </td> <!-- Word -->


                      <td style="max-width: 30px;">
                        {{ json_decode($row->test_score)->grades->classification->first_time }}
                      </td>
                      <td style="max-width: 30px;">
                        {{ json_decode($row->test_score)->grades->classification->second_time }}
                      </td> <!-- XEP Loai -->

                      <td style="max-width: 60px;" >
                        {{ json_decode($row->test_score)->grades->note->value }}
                      </td> <!-- NOTE -->

                    </tr>

                @endforeach
                </tbody>
              </table>

            </div>
            @endif
        </div>
      </div>

    </div>
  </div>
@endsection

@section('extra-js')


@endsection
