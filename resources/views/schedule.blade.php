@extends('layout')

@section('content')

@include('partials.banner')

<section class="room">
  <div class="container">

    <div class="accordion" id="accordionExample">
     @php
       $cateArr = array();
    @endphp
    @foreach ($rooms as $key => $room)
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              {{ $room->name }}
            </button>
          </h2>
        </div>
       @if($room->newclassrooms->count() > 0)
        @foreach($room->newclassrooms as $item)
        <div id="collapseOne" class="collapse {{ $key == 0 ? 'show': ''}}" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
            <table class="table table-striped table-bordered table-responsive-sm">
              <thead class="thead-dark">
              <tr>
                <th scope="col">Lớp</th>
                <th scope="col">Môn Học</th>
                @if(!empty($item->schedule))
                <th scope="col">Thời Gian</th>
                @endif
                <th scope="col">Học Phí</th>
                <th scope="col">Ngày Khai Giảng</th>
                <th style="width: 100px;">&nbsp;</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <th scope="row">{{ $item->HP_id }}</th>
                <td>{{ $item->name }}</td>
                @if(!empty($item->schedule))
                <td>{{ $item->schedule }}</td>
                @endif
                <td>{{ presentPrice($item->fee) }}</td>
                <td>{{ $item->start_day }}</td>
                <td class="text-center">
                  {{--<a href="{{$room->slug}}" class="btn btn-primary btn-register">Đăng ký</a>--}}
                  <form action="{{ route('cart.store') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <input type="hidden" name="hp_id" value="{{ $item->HP_id }}">
                    <input type="hidden" name="name" value="{{ $item->name }}">
                    @if(!empty($item->schedule))
                    <input type="hidden" name="description" value="{{ $item->schedule }}">
                    @endif
                    <input type="hidden" name="fee" value="{{ $item->fee }}">
                    <input type="hidden" name="start_day" value="{{ $item->start_day }}">
                    <button type="submit" class="btn btn-primary btn-register">Đăng ký</button>
                  </form>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      @endforeach
      @endif
      </div>
    @endforeach

    </div>


  </div>
</section>

@endsection
