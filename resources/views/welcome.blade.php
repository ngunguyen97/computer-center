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
                      <a href="{{ url('/')}}">
                    <img src="{{asset('logo.png')}}" alt="Logo" style="width: 70%;" class="logo-desktop">
                      </a>
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
                            <a class="nav-link" href="{{ route('schedule.index')}}">
                              L???ch Khai Gi???ng
                            </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{ route('posts.index') }}">
                            Tin T???c v?? S??? Ki???n
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">
                            Li??n H???
                          </a>
                        </li>

                      </ul>
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
            <p class="schedule__text text-center">L???ch thi</p>
            <h3 class="schedule__heading text-center mb-5">Ch???ng Ch??? Tin H???c</h3>
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
                    <h5 class="card-title">???ng D???ng CNTT</h5>
                    <p class="card-text">Kho ????? thi m???u v?? video h?????ng d???n gi???i ????? gi??p h???c vi???n ??n t???p cho k?? thi ch???ng ch??? CNTT</p>

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
                    <h5 class="card-title">T??i Li???u H???c T???p</h5>
                    <p class="card-text">Chia s??? kho t??i li???u h???c t???p mi???n ph??, h???u ??ch v???i nhi???u l??nh v???c phong ph??.</p>

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
                    <h5 class="card-title">Tra c???u ch???ng ch???</h5>
                    <p class="card-text">H??? tr??? h???c vi??n tra c???u ch???ng ch??? ???????c Trung T??m c???p sau ng??y thi 1,5 th??ng.</p>
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
            <h3 class="schedule__heading text-center mb-5">Tin t???c s??? ki???n</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="card text-white card--medium">
              <img src="{{asset('images/energetic.jpg')}}" class="card-img" alt="energetic">
              <div class="card-img-overlay">
                <h5 class="card-title">T???ng khai gi???ng c??c kh??a h???c t???i Trung t??m Tin h???c</h5>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-sm-12">
            <div class="row">
              <div class="col-md-6">
                <div class="card text-white card__small">
                  <img src="{{asset('images/thisisengineering.jpg')}}" class="card-img" alt="energetic">
                  <div class="card-img-overlay">
                    <h5 class="card-title">Machine Leaning l?? g??? H??y c??ng kh??m ph??</h5>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card text-white card__small">
                  <img src="{{asset('images/pixabay.jpg')}}" class="card-img" alt="energetic">
                  <div class="card-img-overlay">
                    <h5 class="card-title">Thi???t k??? layout webiste</h5>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="card text-white card__small">
                  <img src="{{asset('images/picjumbocom.jpg')}}" class="card-img" alt="energetic">
                  <div class="card-img-overlay">
                    <h5 class="card-title">Thi???t k??? ????? H???a</h5>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card text-white card__small">
                  <img src="{{asset('images/pexels-pixabay.jpg')}}" class="card-img" alt="energetic">
                  <div class="card-img-overlay">
                    <h5 class="card-title">Data Science l?? g???</h5>
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
            <h3 class="footer__heading">Tr??? s??? ch??nh</h3>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">117 Nguy???n V??n Nghi, G?? V???p, Tp HCM</li>
            </ul>
          </div>
          <div class="col-md-4 col-sm-12">
            <h3 class="footer__heading">Gi??? L??m Vi???c</h3>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">T??? Th??? 2 ?????n Th??? 6</li>
              <li class="list-group-item">07h30 -> 19h00</li>
            </ul>
          </div>
          <div class="col-md-4 col-sm-12">
            <h3 class="footer__heading">Ch??nh s??ch v?? quy ?????nh chung</h3>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">??i???u kho???n d???ch v???</li>
              <li class="list-group-item">Ch??nh s??ch b???o m???t</li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

    <script src="{{ asset('js/app.js')}}"></script>
    </body>
</html>
