<section class="navigation">
  <div class="container-fluid">
      <nav class="navbar navbar-expand-lg navbar-light bg-blue">
          <a class="navbar-brand" href="#">
              <img src="{{asset('logo.png')}}" alt="Logo" style="width: 70%;" class="logo-mobile">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              </li>
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
                  <a class="nav-link" href="#">
                    Chương trình đào tạo
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">
                    Tin Tức
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">
                    Liên Hệ
                  </a>
              </li>

            </ul>
            <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-light my-2 my-sm-0" type="submit">Search</button>
            </form>
          </div>
      </nav>
  </div>
</section>
