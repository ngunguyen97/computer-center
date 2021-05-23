@extends('voyager::master')
@section('css')
  <style>
    .w-auto {
      width: 100% !important;
      border: none;
      background-color: transparent;
      padding-left: 10px;
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
  </style>
@endsection
@section('content')
 <div class="panel-body">
   <div class="heading">
     <ul class="list-group list-group-flush">
       <li class="list-group-item">Mã học phần: {{ $classroom[0]->HP }}</li>
       <li class="list-group-item">Tên khóa học: {{ $classroom[0]->roomName }}</li>
     </ul>
   </div>
   <div class="table-responsive">
     <form action="{{ route('attendance.update', ['classroom' =>  $classroom[0]->roomId])}}" method="post" enctype="multipart/form-data">
       {{ method_field('POST') }}
       {{ csrf_field() }}
       <table id="attendance" class="table table-bordered table-striped" cellpadding="2" cellspacing="0">
         <thead>
         <tr>
           <th rowspan="2" style="position: relative"><span class="cell-center">Mã số</span></th>
           <th rowspan="2" style="position: relative"><span class="cell-center">Họ và tên</span></th>
           @foreach($dates[0]->dateRange as $item)
           <th colspan="2" scope="colgroup" style="text-align: center">{{ $item["day_name"] }} - {{ $item["date"] }}</th>
           @endforeach
         </tr>
         <tr>
           @foreach($dates[0]->dateRange as $item)
           <th scope="col">(P/K)</th>
           <th scope="col">ST</th>
           @endforeach
           {{--<th scope="col">(P/K)</th>--}}
           {{--<th scope="col">ST</th>--}}
         </tr>
         </thead>

         <tbody>

            @foreach($students as $student_key => $value)
           <tr>
             <td>
               <span>{{ $value->ID_CARD }}</span>
               <input type="hidden" name="items[{{$student_key}}][userId]" value="{{ $value->userId }}" class="w-auto">
             </td>
             <td style="width: 200px; display: block">
               <span>{{ $value->fullName }}</span>
             </td>
             @if(!empty($value->attendance))
               @foreach(json_decode($value->attendance, true) as $key => $item)
                 <td>
                   <input type="text" name="items[{{$student_key}}][attendance][{{$key}}][pk]" value="{{ $item["pk"] }}" class="w-auto">
                 </td>
                 <td>
                   <input type="text" name="items[{{$student_key}}][attendance][{{$key}}][st]" value="{{ $item["st"] }}" class="w-auto">
                   <input type="hidden" name="items[{{$student_key}}][attendance][{{$key}}][date]" value="{{ $item["date"] }}" class="form-control">
                 </td>
               @endforeach
             @else
               @foreach($dates[0]->dateRange as $key => $item)
               <td>
                 <input type="text" name="items[{{$student_key}}][attendance][buoi_{{$key}}][pk]" value="" class="w-auto">
               </td>
               <td>
                 <input type="text" name="items[{{$student_key}}][attendance][buoi_{{$key}}][st]" value="" class="w-auto">
                 <input type="hidden" name="items[{{$student_key}}][attendance][buoi_{{$key}}][date]" value="{{$item["date"]}}" class="form-control">
               </td>
               @endforeach
             @endif
           </tr>
          @endforeach


         {{--<tr>--}}
           {{--<td>--}}
             {{--<input type="text" name="items[1][id]" value="124" class="form-control">--}}
           {{--</td>--}}
           {{--<td>--}}
             {{--<input type="text" name="items[1][name]" value="Name" class="form-control">--}}
           {{--</td>--}}
           {{--<td> <input type="text" name="items[1][attendance][buoi_1][pk]" value="0" class="form-control"></td>--}}
           {{--<td> <input type="text" name="items[1][attendance][buoi_1][st]" value="0" class="form-control"></td>--}}
           {{--<td> <input type="text" name="items[1][attendance][buoi_2][pk]" value="0" class="form-control"></td>--}}
           {{--<td> <input type="text" name="items[1][attendance][buoi_2][st]" value="0" class="form-control"></td>--}}
         {{--</tr>--}}

         </tbody>
       </table>
       <button type="submit"  class="btn btn-lg btn-success">Lưu</button>
     </form>
   </div>
 </div>
@endsection
