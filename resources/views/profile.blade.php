@extends('app')

@section('content')

<h1>{{ $user->name }}</h1>
<div class="row">
	<div class="col-sm-4">
		<div class="tile-stats tile-orange">
			<div class="icon"><i class="fa fa-users"></i></div>
			<div class="num" data-start="0" data-end="{{ $user->points }}" data-duration="900" data-delay="0">
				{{ $user->points }}
			</div>
			<h3>points</h3>
		</div>
	</div>
	<div class="col-sm-8">
		{!! Form::model($user, [
			'url' => action('UserController@update', $user->id),
			'method' => 'PATCH',
			]) !!}
		<div class="tile-block tile-blue">
			<div class="tile-header">
				<i class="fa fa-pencil"></i>
				@lang('app.profile')
			</div>
			<div class="tile-content">
				<div class="form-horizontal">
					<div class="form-group">
						{!! Form::label('name', null, ['class' => 'col-sm-3 control-label']) !!}
						<div class="col-sm-6">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								{!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
							</div>
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('email', null, ['class' => 'col-sm-3 control-label']) !!}
						<div class="col-sm-6">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
								{!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-3 control-label"></div>
						<div class="col-sm-6">
							<button type="submit" class="btn btn-green btn-icon icon-left btn-block">
								@lang('app.save')</a>
								<i class="fa fa-check"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		{!! Form::close() !!}
	</div>
</div>

<h1>@lang('app.linked_providers')</h1>
<div class="row">
	@foreach($user->oauth_data as $provider)
	<a href="javascript:void(0)" onclick="if({{ strlen($provider->user_data->email) }}) jQuery('input[name=email]').val('{{ $provider->user_data->email }}')" class="col-sm-4">
		<div class="tile-stats tile-aqua">
			<div class="icon"><i class="{{ config("adsocial.provider_icons.$provider->provider") }}"></i></div>
			<div class="num">
				<img width="40" height="40" src="{{ $provider->user_data->avatar }}">
				{{ $provider->user_data->nickname or $provider->provider }}
			</div>
			<h3>{{ $provider->user_data->name }}</h3>
			<p>{{ $provider->user_data->email or trans('app.noemail') }}</p>
		</div>
	</a>
	@endforeach

	@foreach(array_diff(config('adsocial.auth_providers'), $user->providers) as $newProvider)
	<div class="col-sm-4">
		<a href="{{ action('Auth\AuthController@getSocial', $newProvider) }}" class="tile-stats tile-green">
			<div class="icon"><i class="{{ config("adsocial.provider_icons.$newProvider") }}"></i></div>
			<div class="num">
				<i class="fa fa-plus"></i>
				{{ $newProvider }}
			</div>
			<h3>@lang('app.connect')</h3>
			<p>@lang('app.connect_info')</p>
		</a>
	</div>
	@endforeach
</div>

@stop