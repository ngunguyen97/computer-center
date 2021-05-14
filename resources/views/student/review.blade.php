@extends('layout')

@section('title', 'Phúc Khảo')

@section('content')
  <div class="my-profile-section">
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-2 mt-5" style="font-size: 1.6rem;">
          @if (session()->has('success_message'))
            <div class="alert alert-success">
              {{ session()->get('success_message') }}
            </div>
          @endif

          @if(count($errors) > 0)
            <div class="alert alert-danger">
              <ul >
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>
      </div>
    </div>

    <div class="products-section container-fluid">
      <div class="sidebar list-group list-group-flush">
        <ul>
          <li class="list-group-item"><a href="{{ route('student.edit') }}">Hồ sơ</a></li>
          <li class="list-group-item"><a href="#">Phiếu Đăng Ký</a></li>
          <li class="list-group-item"><a href="{{ route('student.checkpoint.show', ['user' => Auth::guard('student')->user()->id ]) }}">Xem Điểm</a></li>
          <li class="active list-group-item"><a href="{{ route('student.review.index') }}">Phúc Khảo</a></li>
        </ul>
      </div> <!-- End Sidebar -->

      <div class="review-test-scores">
        <form action="{{ route('student.review.store', ['user' => Auth::guard('student')->user()->id ]) }}" id="review-test-score-form" method="POST">
          {{ method_field('POST') }}
          {{ csrf_field() }}
          <div class="form-group">
            <label for="classroom_id">Chọn khóa học</label>
            <select class="form-control" id="classroom_id" name="classroom_id" required>
              @if(!empty($classrooms))
                @foreach($classrooms as $classroom)
                <option value="{{ $classroom->id }}">{{ $classroom->HP_id }} - {{ $classroom->name }}</option>
                @endforeach
             @endif
            </select>

          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Nội Dung</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="content" rows="5" required></textarea>
          </div>


          <button type="submit" class="btn btn-primary my-review-button">Gửi</button>
        </form>
      </div>
    </div>
  </div>
@endsection
