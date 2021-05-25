@extends('layout')

@section('extra-css')
  <style>
    .post {
      margin: 2rem 0;
      font-size: 1.6rem;
      min-height: 40rem;
    }
  </style>
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="post">
          <h1 class="text-center">{{ $post->title }}</h1>
          <div class="spacer"></div>
          {{--{{ dd(json_decode($post->meta_description)) }}--}}
          @if(!empty($post->meta_description) && !empty(json_decode($post->meta_description)))
          <?php $name = (json_decode($post->meta_description))[0]->original_name; ?>
            <a href="{{ route('post.download', ['slug' => $post->slug]) }}" target="_blank">
              <i class="fa fa-download" aria-hidden="true"></i>
              {{ $name }}
            </a>
          @endif
          <div class="spacer"></div>
          <div class="content">
            {!! $post->body !!}
          </div>
        </div>
      </div>
    </div>
  </div>
  {{--{{ dd($post) }}--}}
@endsection
