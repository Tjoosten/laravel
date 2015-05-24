@extends('layouts.acl')

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
	<div role="tabpanel" class="tab-pane fade in active" id="home">
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
									 	<span class="label label-success">Actief</span>
									@endif
								</td>

								<td>
									@if($output->role == "A")
										<span class="label label-danger">Administrator</span>
									@endif
							 	</td>

								<td> {!! $output->email !!} </td>

								<td>
									<div class="btn-group">
										<a class="btn btn-xs btn-danger"><span class="fa fa-lock"></span></a>
										<a class="btn btn-xs btn-danger"><span class="fa fa-asterisk"></span></a>
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
