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
            <span class=""></span>
            {!! Lang::get('navbar.words') !!}
          </a>
        </li>
        <li>
          <span class="fa fa-file-text"></span>
          <a href="">
            {!! Lang::get('navbar.insertNewWord') !!}
          </a>
        </li>
        <li>
          <span class="fa fa-envelope"></span>
          <a href="">
            {!! Lang::get('navbar.contact') !!}
          </a>
        </li>
      </ul>

      @if(Auth::check())
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
