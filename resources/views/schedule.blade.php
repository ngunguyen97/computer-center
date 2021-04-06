@extends('layout')

@section('content')

@include('partials.banner')

<section class="room">
  <div class="container">
    <table class="table table-striped table-bordered table-responsive-sm">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Lớp</th>
          <th scope="col">Môn Học</th>
          <th scope="col">Ngày Khai Giảng</th>
          <th scope="col">Học Phí</th>
          <th scope="col">Thời Gian</th>
          <th>&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($rooms as $room)
          <tr>
            <th scope="row">{{ $room->MaHP }}</th>
            <td>{{ $room->TenLH }}</td>
            <td>{{ $room->LichHoc }}</td>
            <td>{{ presentPrice($room->HocPhi) }}</td>
            <td>{{ $room->NgayBD }}</td>
            <td>
              <a href="{{$room->slug}}" class="btn btn-primary btn-register">Đăng ký</a>
            </td>
          </tr>
        @endforeach

      </tbody>
    </table>
  </div>
</section>

@endsection
