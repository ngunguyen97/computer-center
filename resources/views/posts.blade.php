@extends('layout')

@section('extra-css')
  <style>
    .line {
      width: 100%;
      border-bottom: 1px dashed #999999;
      margin: 5px;
      clear: both;
    }
    .mrtb-2 {
      margin: 2rem 0;
    }
    .posts {
      font-size: 1.6rem;
    }
    .posts .card {
      max-width: 84rem;
      background-color: transparent;
      border: none;
    }
    .posts a {
      color: #337ab7;
      text-decoration: none;
    }
    .posts a h5 {
      font-size: 1.6rem;
    }
  </style>

@endsection

@section('content')
  <section class="news mrtb-2">
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

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="posts">
          @foreach($posts as $post)
          <div class="col-md-12 line"></div>
          <div class="card mb-3">
            <div class="row no-gutters">
              <div class="col-md-4">
                <a href="{{route('post.show', $post->slug)}}">
                  <img src="{{ loadImageViaS3($post->image) }}" alt="{{ $post->title }}" class="img-thumbnail">
                </a>
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <a href="{{route('post.show', $post->slug)}}"> <h5 class="card-title">{{ $post->title }}</h5></a>
                  <p class="card-text">{{ $post->excerpt }}</p>
                  <p class="card-text"><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small></p>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection
