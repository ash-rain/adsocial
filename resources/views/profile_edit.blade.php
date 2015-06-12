@extends('app')

@section('content')

<h1>
	@lang('app.hi')
	{{ $user->name }}
</h1>

<div class="row">
	<div class="col-sm-3">
		<div class="tile-stats tile-gray">
			<div class="icon"><i class="fa fa-line-chart"></i></div>
			<div class="num" data-start="0" data-end="{{ $user->points }}" data-duration="900" data-delay="0">
				{{ $user->points }}
			</div>
			<h3>points</h3>
		</div>
		<a id="buy" href="{{ url('/') }}" class="tile-stats tile-red">
			<i class="fa fa-dollar"></i>
			Buy Points
			{{-- <div class="icon"><i class="fa fa-cc-paypal"></i></div> --}}
		</a>
	</div>

	<div class="col-sm-5">
		<div class="scrollable" data-height="195">
			<ul class="list-group">
				@foreach(range(1, 10) as $i)
				<li class="list-group-item">
					<span class="badge badge-success">
						+7
					</span>
					<strong>Reason</strong>
					<div>
						<a href="#">
							<i class="fa fa-hand-o-up"></i>
							Link to resource
						</a>
						<div class="pull-right">
							<i class="fa fa-clock-o"></i>
							<small>{{ Carbon\Carbon::now()->diffForHumans() }}</small>
						</div>
					</div>
				</li>
				@endforeach
			</ul>
			<a href="#">@lang('app.show_older')</a>
		</div>
	</div>

	<div class="col-sm-4">
		<div class="scrollable" data-height="195">
			<ul class="list-group">
				@foreach(range(1, 3) as $i)
				<li class="list-group-item">
					<span class="badge badge-warning">
						-10
					</span>
					<strong>Reason</strong>
					<div>
						<a href="#">
							<i class="fa fa-hand-o-up"></i>
							Link to resource
						</a>
						<div class="pull-right">
							<i class="fa fa-clock-o"></i>
							<small>{{ Carbon\Carbon::now()->diffForHumans() }}</small>
						</div>
					</div>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-5">
		<h2>
			<i class="fa fa-pencil-square-o"></i>
			@lang('app.profile')
		</h2>
		{!! Form::model($user, [
			'url' => action('UserController@update', $user->id),
			'method' => 'PATCH',
			'class' => 'form-horizontal'
			]) !!}
			<div class="form-group {{ !$user->name ? 'has-error' : '' }}">
				{!! Form::label('name', trans('app.name'), ['class' => 'col-sm-3 control-label']) !!}
				<div class="col-sm-9">
					{!! Form::text('name', null, ['class' => 'form-control input-lg', 'placeholder' => trans('app.name_required'), 'required']) !!}
				</div>
			</div>
			<div class="form-group {{ !$user->email ? 'has-error' : '' }}">
				{!! Form::label('email', trans('app.email'), ['class' => 'col-sm-3 control-label']) !!}
				<div class="col-sm-9">
					{!! Form::email('email', null, ['class' => 'form-control input-lg', 'placeholder' => trans('app.email_required'), 'required']) !!}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<button type="submit" class="btn btn-lg btn-green btn-icon icon-left btn-block">
						@lang('app.save')</a>
						<i class="fa fa-check"></i>
					</button>
				</div>
			</div>
		{!! Form::close() !!}
	</div>

	<div class="col-sm-7">
		<h2>
			<i class="fa fa-link"></i>
			@lang('app.linked_providers')
		</h2>
		<div class="row">
			@foreach($user->oauth_data as $provider)
			<div class="col-sm-6">
				<a href="javascript:void(0)" onclick="if({{ strlen($provider->user_data->email) }}) jQuery('input[name=email]').val('{{ $provider->user_data->email }}')">
					<div class="tile-stats tile-aqua">
						<div class="icon"><i class="{{ config("adsocial.$provider->provider.icon") }}"></i></div>
						<div class="num">
							<img width="40" height="40" src="{{ $provider->user_data->avatar }}">
							{{ $provider->user_data->nickname or $provider->provider }}
						</div>
						<h3>{{ $provider->user_data->name }}</h3>
						<p>{{ $provider->user_data->email or trans('app.noemail') }}</p>
					</div>
				</a>
			</div>
			@endforeach

			@foreach(array_diff(array_keys(config('adsocial.actions')), $user->providers) as $newProvider)
			<div class="col-sm-6">
				<a href="{{ action('AuthController@getSocial', $newProvider) }}" class="tile-stats tile-cyan">
					<div class="icon"><i class="{{ config("adsocial.$newProvider.icon") }}"></i></div>
					<div class="num">
						<i class="fa fa-user-plus"></i>
						{{ $newProvider }}
					</div>
					<h3>@lang('app.connect')</h3>
					<p>@lang('app.connect_info')</p>
				</a>
			</div>
			@endforeach
		</div>
	</div>
</div>

@stop