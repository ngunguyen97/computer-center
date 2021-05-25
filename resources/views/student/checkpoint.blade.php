@extends('layout')

@section('title', 'Xem điểm')

@section('content')
  <div class="my-profile-section">
    <div class="products-section container-fluid">
      <div class="sidebar list-group list-group-flush">
        @include('partials.menus.sidebar-left')
      </div> <!-- End Sidebar -->

      <div class="my-checkpoint">
        <div class="show-grades">
          @if($officeComputing->count() > 0 )
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

                      @if(!empty($row->test_score))
                        @foreach(json_decode($row->test_score, true) as $key => $value)
                          <td style="max-width: 30px;">
                            {{ $value["first_time"] }}
                          </td>
                          <td style="max-width: 30px;">
                            {{ $value["second_time"] }}
                          </td><!-- Ly Thuyet -->
                        @endforeach
                      @else
                        @for($i = 0 ;$i < 6; $i++)
                          <td style="max-width: 30px;"></td>
                          <td style="max-width: 30px;"></td>
                        @endfor
                      @endif


                    </tr>

                  @endif
                @endforeach
                </tbody>
              </table>
            </div>
          @endif
            <div class="spacer"></div>
            @if(!empty($anotherType) && $anotherType->count() > 0 )
            <div class="another-grade-type">
              <table id="anotherGradeType" class="table table-bordered table-striped fs-14 text-center" cellpadding="2" cellspacing="0">
                <thead>
                <tr>
                  <th rowspan="2" style="position: relative;"><span class="th-table-center">Mã học phần</span></th>
                  <th rowspan="2" style="position: relative;"><span class="th-table-center">Tên khóa học</span></th>
                  <th colspan="2" scope="colgroup">Lý Thuyết</th>
                  <th colspan="2" scope="colgroup">Thực Hành</th>
                  <th colspan="2" scope="colgroup">Xếp Loại</th>
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
                @foreach($anotherType as $row)
                    <tr class="text-center">
                      <td style="width: 160px">{{ $row->HP_id }}</td>
                      <td style="width: 180px;">{{ $row->name }}</td>
                      @if(!empty($row->test_score))
                        @foreach(json_decode($row->test_score, true) as $key => $value)
                          <td style="max-width: 30px;">
                            {{ $value["first_time"] }}
                          </td>
                          <td style="max-width: 30px;">
                            {{ $value["second_time"] }}
                          </td><!-- Ly Thuyet -->
                        @endforeach
                       @else
                       @for($i = 0 ;$i < 4; $i++)
                          <td style="max-width: 30px;"></td>
                          <td style="max-width: 30px;"></td>
                       @endfor
                      @endif
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
