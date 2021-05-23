<section class="navigation">
  <div class="container-fluid">
      <nav class="navbar navbar-expand-lg navbar-light bg-blue">
          <a class="navbar-brand" href="{{ url('/')}}">
              <img src="{{asset('logo.png')}}" alt="Logo" style="width: 70%;" class="logo-mobile">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/')}}">
                  <i class="fa fa-home" aria-hidden="true"></i>
                </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('schedule.index') }}">
                    Lịch Khai Giảng
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('posts.index') }}">
                    Tin Tức và Sự Kiện
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">
                    Liên Hệ
                  </a>
              </li>

            </ul>
            <span class="navbar-text">
              <a href="{{ route('cart.index') }}" style="font-size: 1.6rem;">
                <i class="fa fa-cart-plus" aria-hidden="true"></i>
              </a>
              @if (Cart::instance('default')->count() > 0 )
                <span class="cart-count badge badge-light">{{ Cart::instance('default')->count() }}</span><span></span>
              @else
                <span class="cart-count">0</span><span></span>
              @endif
            </span>
            {{--<form class="form-inline my-2 my-lg-0">--}}
              {{--<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">--}}
              {{--<button class="btn btn-light my-2 my-sm-0" type="submit">Search</button>--}}
            {{--</form>--}}
            @include('partials.menus.main-right')
          </div>
      </nav>
  </div>
</section>
