<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Computer Training | @yield('title', '')</title>

        <!-- Fonts -->
        {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet"> --}}

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
      @yield('extra-css')
    </head>
    <body>
      @include('partials.header')
      @include('partials.nav')

      @yield('content')

      @include('partials.footer')

      {{-- @include('partials.footer') --}}
      <script src="{{ asset('js/app.js')}}"></script>

      @yield('extra-js')

    </body>
</html>
