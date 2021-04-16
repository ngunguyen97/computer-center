@extends('layout')

@section('title', 'Shopping Cart')

@section('content')
  <div class="cart-section container">
    <div>
      <div class="cart-message">
        @if (session()->has('success_message'))
          <div class="alert alert-success">
            {{session()->get('success_message')}}
          </div>
        @endif

        @if (count($errors) > 0 )
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
              @endforeach
            </ul>
          </div>
        @endif
      </div>
      @if(Cart::count() > 0)
        <h2>Thông tin khóa học</h2>
        <div class="cart-table">
          @foreach(Cart::content() as $item)
            <div class="cart-table-row">
              <table class="table table-bordered">
                <thead>
                <tr>
                  <th scope="col">Môn học</th>
                  <th scope="col">Mã Học Phần</th>
                  <th scope="col">Lịch học</th>
                  <th scope="col">Học phí</th>
                  <th scope="col">Ngày khai giảng</th>
                  <th scope="col">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <th scope="row">{{ $item->name }}</th>
                  <td>{{ $item->options->hp_id }}</td>
                  <td>{{ $item->options->description }}</td>
                  <td>{{ Cart::total() }} <span class="cart-currency">đ</span></td>
                  <td>{{ $item->options->description }}</td>
                  <td>
                    <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button type="submit" class="cart-options">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                      </button>
                    </form>
                  </td>
                </tr>
                </tbody>
              </table> <!-- end table-bordered -->
            </div> <!-- end cart-table-row -->
          @endforeach
        </div> <!-- end cart-table -->
        <div class="cart-action-row">
          <div class="cart-buttons">
            <a href="{{ route('checkout.index') }}" class="button-primary">Proceed to Checkout</a>
          </div>
        </div>
      @else
        <h3>Bạn chưa đăng ký Môn học nào</h3>
        <div class="spacer"></div>
        <a href="{{ route('schedule.index') }}" class="button">Lịch khai giảng</a>
        <div class="spacer"></div>
      @endif
    </div>

  </div> <!-- end cart-section -->

@endsection
