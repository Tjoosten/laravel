@extends('layouts.words')

@section('SideColumn')
  <div class="panel panel-default">
    <div class="panel-heading"> {!! Lang::get('words.Search') !!} </div>

    <div class="panel-body">
    </div>
  </div>
@stop

@section('content')
  @if(Auth::check())
    <div class="text-right">
      <a href="" class="btn btn-danger">Meh</a>
      <a href="" class="btn btn-success">Merh</a>
    </div>
  @endif

  <table class="table table-condensed table-hover">
    <thead>
      <tr>
        <th>{!! Lang::get('words.TableWord') !!}</th>
        <th>{!! Lang::get('words.TableDialect') !!}</th>
        <th> {!! Lang::get('words.TableDescription') !!} </th>
        <th></th> {{-- Read more --}}
      </tr>
    </thead>
    <tbody>
      @foreach($query as $output)
        <tr>
          <td> {!! $output->word !!} </td>
          <td> {!! $output->dialect !!} </td>
          <td> {!! $output->description !!}</td>

          <td>
            <a href="">
              {!! Lang::get('words.readmore') !!}
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
