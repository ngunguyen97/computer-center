<ul>
  <li class="list-group-item {{ Route::currentRouteName() == 'student.edit' ? 'active' : '' }} "><a href="{{ route('student.edit') }}">Hồ sơ</a></li>
  <li class="list-group-item"><a href="#">Phiếu Đăng Ký</a></li>
  <li class="list-group-item {{ Route::currentRouteName() == 'student.checkpoint.show' ? 'active' : '' }}"><a href="{{ route('student.checkpoint.show', ['user' => Auth::guard('student')->user()->id ]) }}">Xem Điểm</a></li>
  <li class="list-group-item {{ Route::currentRouteName() == 'student.review.index' ? 'active' : '' }}"><a href="{{ route('student.review.index') }}">Phúc Khảo</a></li>
  <li class="list-group-item {{ Route::currentRouteName() == 'student.reexamination.index' ? 'active' : '' }}"><a href="{{ route('student.reexamination.index') }}">Đăng ký thi lại</a></li>
  <li class="list-group-item">
    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
      Lịch Học Tập
    </button>
    <div class="collapse" id="collapseExample">
      <div class="card card-body">
        <ul>
          <li class="list-group-item {{ Route::currentRouteName() == 'student.calendar.index' ? 'active' : '' }}"><a href="{{ route('student.calendar.index') }}">Xem lịch học và lịch thi</a></li>
          <li class="list-group-item {{ Route::currentRouteName() == 'student.reexamination.show' ? 'active' : '' }}"><a href="{{ route('student.reexamination.show') }}">Xem lịch thi lại</a></li>
        </ul>
      </div>
    </div>
  </li>

</ul>
