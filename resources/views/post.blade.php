@extends('layout')

@section('extra-css')
  <style>
    .post {
      margin: 2rem 0;
      font-size: 1.6rem;
    }
  </style>
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="post">
          <h1 class="text-center">{{ $post->title }}</h1>
          <div class="content">
            {!! $post->body !!}
          </div>
        </div>
      </div>
    </div>
  </div>
  {{--{{ dd($post) }}--}}
@endsection
