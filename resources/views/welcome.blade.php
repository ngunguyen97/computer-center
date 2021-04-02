<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Computer Training</title>

        <!-- Fonts -->
        {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet"> --}}

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <body>
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                    <img src="{{asset('logo.png')}}" alt="Logo" style="width: 70%;" class="logo-desktop">
                    </div>
                </div>
            </div>
        </header>
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
                          <a class="nav-link" href="#">
                            <i class="fa fa-home" aria-hidden="true"></i>
                          </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
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

      <section class="banner">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" style=" width:100%; height: 550px !important;">
            <div class="carousel-item active">
              <img src="{{asset('images/pexels-alexander-suhorucov-6457541.jpg')}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="{{asset('images/pexels-alexander-suhorucov-6457541.jpg')}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="{{asset('images/pexels-alexander-suhorucov-6457541.jpg')}}" class="d-block w-100" alt="...">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </section>

    <section class="schedule">
      <div class="container">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <p class="schedule__text text-center">Lịch thi</p>
            <h3 class="schedule__heading text-center mb-5">Chứng Chỉ Tin Học</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-sm-12">
            <div class="card mb-3" style="max-width: 540px;">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img src="{{asset('images/grade.png')}}" alt="Grade" class="d-block w-100 p-10">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">Ứng Dụng CNTT</h5>
                    <p class="card-text">Kho đề thi mẫu và video hướng dẫn giải đề giúp học viện ôn tập cho kì thi chứng chỉ CNTT</p>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-12">
            <div class="card mb-3" style="max-width: 540px;">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img src="{{asset('images/books.png')}}" alt="Grade" class="d-block w-100 p-10">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">Tài Liệu Học Tập</h5>
                    <p class="card-text">Chia sẻ kho tài liệu học tập miễn phí, hữu ích với nhiều lĩnh vực phong phú.</p>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-12">
            <div class="card mb-3" style="max-width: 540px;">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img src="{{asset('images/grade.png')}}" alt="Grade" class="d-block w-100 p-10">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">Tra cứu chứng chỉ</h5>
                    <p class="card-text">Hỗ trợ học viên tra cứu chứng chỉ được Trung Tâm cấp sau ngày thi 1,5 tháng.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="news">
      <div class="container">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <h3 class="schedule__heading text-center mb-5">Tin tức sự kiện</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="card text-white card--medium">
              <img src="{{asset('images/energetic.jpg')}}" class="card-img" alt="energetic">
              <div class="card-img-overlay">
                <h5 class="card-title">Tổng khai giảng các khóa học tại Trung tâm Tin học</h5>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-sm-12">
            <div class="row">
              <div class="col-md-6">
                <div class="card text-white card__small">
                  <img src="{{asset('images/thisisengineering.jpg')}}" class="card-img" alt="energetic">
                  <div class="card-img-overlay">
                    <h5 class="card-title">Machine Leaning là gì? Hãy cùng khám phá</h5>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card text-white card__small">
                  <img src="{{asset('images/pixabay.jpg')}}" class="card-img" alt="energetic">
                  <div class="card-img-overlay">
                    <h5 class="card-title">Thiết kế layout webiste</h5>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="card text-white card__small">
                  <img src="{{asset('images/picjumbocom.jpg')}}" class="card-img" alt="energetic">
                  <div class="card-img-overlay">
                    <h5 class="card-title">Thiết kế Đồ Họa</h5>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card text-white card__small">
                  <img src="{{asset('images/pexels-pixabay.jpg')}}" class="card-img" alt="energetic">
                  <div class="card-img-overlay">
                    <h5 class="card-title">Data Science là gì?</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-12">
            <h3 class="footer__heading">Trụ sở chính</h3>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">117 Nguyễn Văn Nghi, Gò Vấp, Tp HCM</li>
            </ul>
          </div>
          <div class="col-md-4 col-sm-12">
            <h3 class="footer__heading">Giờ Làm Việc</h3>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Từ Thứ 2 đến Thứ 6</li>
              <li class="list-group-item">07h30 -> 19h00</li>
            </ul>
          </div>
          <div class="col-md-4 col-sm-12">
            <h3 class="footer__heading">Chính sách và quy định chung</h3>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Điều khoản dịch vụ</li>
              <li class="list-group-item">Chính sách bảo mật</li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

    <script src="{{ asset('js/app.js')}}"></script>
    </body>
</html>
