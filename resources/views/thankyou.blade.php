@extends('layout')

@section('title', 'Thank You')

@section('extra-css')

@endsection

@section('body-class', 'sticky-footer')

@section('content')

  <div class="thank-you-section">
    <h1>Cảm ơn bạn đã tin tưởng và chọn trung tâm.</h1>
    <p>Một email xác nhận đã được gửi</p>
    <div class="spacer"></div>
    <div>
      <a href="{{ url('/') }}" class="button">Trang chủ</a>
    </div>
  </div>




@endsection
