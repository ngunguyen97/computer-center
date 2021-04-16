@extends('layout')

@section('content')

@include('partials.banner')

<section class="room">
  <div class="container">

    <div class="accordion" id="accordionExample">
    @foreach ($rooms as $key => $room)
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              @foreach($room->categories as $category)
                {{ $category->name }}
              @endforeach
            </button>
          </h2>
        </div>

        <div id="collapseOne" class="collapse {{ $key == 0 ? 'show': ''}}" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
            <table class="table table-striped table-bordered table-responsive-sm">
              <thead class="thead-dark">
              <tr>
                <th scope="col">Lớp</th>
                <th scope="col">Môn Học</th>
                <th scope="col">Thời Gian</th>
                <th scope="col">Học Phí</th>
                <th scope="col">Ngày Khai Giảng</th>
                <th style="width: 100px;">&nbsp;</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <th scope="row">{{ $room->HP_id }}</th>
                <td>{{ $room->name }}</td>
                <td>{{ $room->schedule }}</td>
                <td>{{ presentPrice($room->fee) }}</td>
                <td>{{ $room->start_day }}</td>
                <td class="text-center">
                  {{--<a href="{{$room->slug}}" class="btn btn-primary btn-register">Đăng ký</a>--}}
                  <form action="{{ route('cart.store') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $room->id }}">
                    <input type="hidden" name="hp_id" value="{{ $room->HP_id }}">
                    <input type="hidden" name="name" value="{{ $room->name }}">
                    <input type="hidden" name="description" value="{{ $room->schedule }}">
                    <input type="hidden" name="fee" value="{{ $room->fee }}">
                    <input type="hidden" name="start_day" value="{{ $room->start_day }}">
                    <button type="submit" class="btn btn-primary btn-register">Đăng ký</button>
                  </form>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    @endforeach

    </div>


  </div>
</section>

@endsection
