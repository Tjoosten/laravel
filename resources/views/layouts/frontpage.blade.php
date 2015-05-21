<!DOCTYPE html>
<html lang="nl">
  <head>
    {{-- Header component --}}
      @include('components.header')
  </head>

  <body>
    {{-- Navbar component --}}
      @include('components.navbar')

    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          @yield('content')
        </div>
      </div>

      <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
          @yield('section01')
        </div>

        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
          @yield('section02')
        </div>

        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
          @yield('section03')
        </div>
      <div>

    </div>

    {{-- JavaScript at the bottom so the page renders faster --}}
      @include('components.footer')
  </body>
</html>
