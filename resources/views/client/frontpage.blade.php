@extends('layouts.frontpage')

@section('content')
<div class="jumbotron">
  <h1>{!! Lang::get('navbar.title') !!}</h1>

  <p>{!! Lang::get('frontpage.description') !!}</p>
</div>
@stop
