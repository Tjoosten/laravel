!DOCTYPE html>
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
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
          @yield('SideColumn')
        </div>

        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
          @yield('content')
        </div>
      </div>
    </div>

    {{-- JavaScript at the bottom so the page renders faster --}}
      @include('components.footer')
  </body>
</html>
