<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button
        type="button"
        class="navbar-toggle collapsed"
        data-toggle="collapse"
        data-target="#navbar"
        aria-expanded="false"
        aria-controls="navbar"
      >
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">{!! Lang::get('navbar.title') !!}</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li>
          <a href="">
            <span class="fa fa-file-text-o"></span>
            {!! Lang::get('navbar.words') !!}
          </a>
        </li>
        <li>
          <a href="">
            <span class="fa fa-plus"></span>
            {!! Lang::get('navbar.insertNewWord') !!}
          </a>
        </li>
        <li>
          <a href="">
            <span class="fa fa-envelope"></span>
            {!! Lang::get('navbar.contact') !!}
          </a>
        </li>
      </ul>

      @if(Auth::check())
        <ul class="nav navbar-nav navbar-right">
          <li> 
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              {!! Auth::user()->firstname !!} {!! Auth::user()->lastname !!}
            </a>

            <ul class="dropdown-menu">
              <li><a href="">{!! Lang::get('navbar.logout') !!}</a>
            </ul>
          </li>
        </ul>
      @else
        <form method="POST" action="/auth/verify" class="navbar-form navbar-right">
          {{-- CSRF Protection --}}
          <input type="hidden" name="_token" value="{!! csrf_token(); !!}">

          <div class="form-group">
            {!! Form::text('email', null, array('class'=>'form-control', 'placeholder'=> Lang::get('navbar.formEmail'))) !!}
          </div>
          <div class="form-group">
            <input type="password" name="password" placeholder="{!! Lang::get('navbar.formPass') !!}" class="form-control">
          </div>
          <button type="submit" class="btn btn-success">{!! Lang::get('navbar.login') !!}</button>
        </form>
      @endif
    </div><!--/.nav-collapse -->
  </div>
</nav>
