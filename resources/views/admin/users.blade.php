@extends('layouts.acl')

@section('alert')

	<script>
		window.setTimeout(function() {
			$("#notification").fadeTo(500, 0).slideUp(500, function(){
				$(this).remove();
			});
		}, 3000);
	</script>

	@if(count($errors->all()) > 0)
		<div id="notification" class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
					<li>{!! $error !!}</li>
				@endforeach
			</ul>
		</div>
	@elseif(Session::has('message') && Session::has('class') && Session::has('heading'))
		<div id="notification" class="{{ Session::get('class') }}">
	  	<h4> {{ Session::get('heading') }} </h4>
	  	<p> {{ Session::get('message') }} </p>
		</div>
	@endif
@stop

@section('nav')
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#home" aria-controls="home" role="tab" data-toggle="tab">
				{!! Lang::get('acl.users') !!}
			</a>
		</li>
		<li role="presentation">
			<a href="#new" aria-controls="home" role="tab" data-toggle="tab">
				{!! Lang::get('acl.newUser') !!}
			</a>
		</li>
	</ul>
@stop

@section('users')
	<div role="tabpanel" class="tab-pane active" id="home">
		<div style="margin-top: 10px;"></div>
		<div class="row">
			<div class="col-xs-9 col-md-9 col-sm-9 col-lg-9">
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>{!! Lang::get('acl.username') !!}</th>
							<th>{!! Lang::get('acl.state') !!}</th>
							<th>{!! Lang::get('acl.role') !!}</th>
							<th>{!! Lang::get('acl.email') !!}</th>
							<th></th> {{-- Functions --}}
						</tr>
					</thead>
					<tbody>
						@foreach($query as $output)
							<tr>
								<td><code>#{!! $output->id !!}</code></td>
								<td> {!! $output->firstname !!} {!! $output->lastname !!} </td>

								<td>
									@if($output->active == "Y")
									 	<span class="label label-success">{!! Lang::get('acl.active') !!}</span>
									@elseif($output->active == "N")
										<span class="label label-info">{!! Lang::get('acl.nonActive') !!}</span>
									@endif
								</td>

								<td>
									@if($output->role == "A")
										<span class="label label-danger">{!! Lang::get('Administrator') !!}</span>
									@elseif($output->role == "U")
										<span class="label label-warning">{!! Lang::get('acl.user') !!}</span>
									@endif
							 	</td>

								<td> {!! $output->email !!} </td>

								<td>
									<div class="btn-group">
										@if($output->active == "Y")
											<a title="{!! Lang::get('acl.titleBlock') !!}" class="btn btn-xs btn-danger" href="/user/block/{!! $output->id !!}">
												<span class="fa fa-lock"></span>
											</a>
										@elseif($output->active == "N")
											<a title="{!! Lang::get('titleUnblock') !!}" class="btn btn-xs btn-danger" href="/user/unblock/{!! $output->id !!}">
												<span class="fa fa-unlock"></span>
											</a>
										@endif

										@if($output->role == "U")
											<a title="{!! Lang::get('acl.titleAdmin') !!}" class="btn btn-xs btn-danger" href="/user/admin/{!! $output->id !!}">
												<span class="fa fa-asterisk"></span>
											</a>
										@elseif($output->role ==  "A")
											<a title="{!! Lang::get('acl.titleUser') !!}" class="btn btn-xs btn-danger" href="/user/undoAdmin/{!! $output->id !!}">
												<span class="fa fa-asterisk"></span>
											</a>
										@endif

										<a class="btn btn-xs btn-danger" title="{!! Lang::get('acl.titleDelete') !!}" href="/user/delete/{!! $output->id !!}">
											<span class="fa fa-trash-o"></span>
										</a>
									</div>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop

@section('newUser')
<div role="tabpanel" class="tab-pane" id="new">
	<div style="margin-top: 10px;"></div>
	<div class="row">
		<div class="col-xs-9 col-md-9 col-sm-9 col-lg-9">

			{{-- Begin form --}}
			<form method="POST" action="/user/register">
				{{-- CSRF Token --}}
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">

				<label for="01">{!! Lang::get('register.firstname') !!}</label>
				<input id="01" type="text" placeholder="{!! Lang::get('register.firstname') !!}" name="firstname" class="width-register form-control" />
				<br />

				<label for="02">{!! Lang::get('register.lastname') !!}</label>
				<input id="02" type="text" placeholder="{!! Lang::get('register.lastname') !!}" name="lastname" class="width-register form-control" />
				<br />

				<label for="03">{!! Lang::get('register.email') !!}</label>
				<input id="03" type="text" placeholder="{!! Lang::get('register.email') !!}" name="email" class="width-register form-control" />
				<br />

				<label for="04"> {!! Lang::get('register.birth') !!} </label>
				<input id="04" type="text" placeholder="{!! Lang::get('register.birth') !!}" name="birth" class="width-register form-control" />
				<br />

				<label for="05">{!! Lang::get('register.education') !!}</label>
				<select id="05" class="width-register form-control" name="job">
					@foreach($jobs as $job)
						<option value="{!! $job->id !!}"> {!! $job->jobs !!} </option>
					@endforeach
				</select>
				<br />

				<button type="submit" class="btn btn-success"> {!! Lang::get('register.submit') !!}</button>
				<button type="reset" class="btn btn-danger"> {!! Lang::get('register.reset') !!} </button>
			</form>
			{{-- END form --}}

		</div>
	</div>
</div>
@stop
