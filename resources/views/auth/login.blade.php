@extends('layout')

@section('content')
<div class="container">
    <div class="auth-pages">
        <div class="auth-left">
          @if (session()->has('error'))
            <div class="alert alert-danger">
              {{session()->get('error')}}
            </div>
          @endif
            <div class="student-card">
              <div class="student-card-header">{{ $title ?? 'Login' }}</div>
              <div class="spacer"></div>

                <div class="student-card-body">
                  <form method="POST" action="{{ route($loginRoute) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mật khẩu') }}</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Ghi nhớ') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary auth-button">
                                    {{ __('Đăng nhập') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route($forgotPasswordRoute) }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

      <div class="auth-right">
        <h2>Những khóa học hấp dẫn đang chờ bạn</h2>
        <div class="spacer"></div>
        <p><strong>Tiết kiệm thời gian ngay bây giờ.</strong></p>
        <p>Đăng ký và thanh toán một cách thuận tiện.</p>
        <div class="spacer"></div>
        <a href="#" class="auth-button-hollow">Lịch khai giảng</a>
        <div class="spacer"></div>
        &nbsp;
      </div>
    </div>
</div>
@endsection
