@extends('layout')

@section('title', 'Hồ Sơ')

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
    <div class="products-section container">
      <div class="sidebar list-group list-group-flush">
        <ul>
          <li class="active list-group-item"><a href="{{ route('student.edit') }}">My Profile</a></li>
          <li class="list-group-item"><a href="#">My Orders</a></li>
        </ul>
      </div> <!-- End Sidebar -->
      <div class="my-profile">
        <div class="products-header">
          <h1 class="stylish-heading">My Profile</h1>
        </div>

        <div>
          <form action="{{ route('student.update') }}" method="POST">

            {{ method_field('PATCH') }}
            {{ csrf_field() }}

            <div class="form-control">
              <input id="fullname" type="text" name="fullname" value="{{ old('fullname', $user->fullname) }}" placeholder="Name" required>
            </div>
            <div class="form-control">
              <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Email" required>
            </div>
            <div class="form-control">
              <input id="password" type="password" name="password" placeholder="Password">
              <div>Leave password blank to keep current password</div>
            </div>
            <div class="form-control">
              <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password">
            </div>
            <div>
              <button type="submit" class="my-profile-button">Update Profile</button>
            </div>
          </form>
        </div>

        <div class="spacer"></div>
      </div>
    </div>
  </div>
@endsection
