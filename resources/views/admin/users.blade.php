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
