@extends('app')

@section('js')
$(function() {
	$('.tile-stats a.detach').click(function(e) {
		e.preventDefault()
		if(confirm("@lang('app.confirm_detach')")) {
			$.get($(this).attr('href'), function(r) {
				if(r.success) window.location.reload()
			});
		}
	})
})
@stop

@section('content')

@include('modals.buy')

@if($user->name)
<h1>
	@lang('app.hi')
	{{ $user->name }}
</h1>
@endif

@if($user->email)
<div class="row">
	<div class="col-sm-3">
		<div class="tile-stats tile-gray">
			<div class="icon"><i class="fa fa-line-chart"></i></div>
			<div class="num" data-start="0" data-end="{{ $user->points }}" data-duration="900" data-delay="0"></div>
			<h3>@lang('app.points')</h3>
		</div>
		<a href="#" id="buy" data-toggle="modal" data-target="#buyModal" class="tile-stats tile-red">
			<i class="fa fa-dollar"></i>
			@lang('app.buy_points')
			{{-- <div class="icon"><i class="fa fa-cc-paypal"></i></div> --}}
		</a>
	</div>

	<div class="col-sm-5">
		<div class="scrollable" data-height="195">
			<ul class="list-group">
				@foreach($earned as $item)
				<li class="list-group-item">
					<span class="badge badge-success">
						+{{ $item->reward ? $item->reward : $item->market_reward }}
					</span>

					@unless($item->reward)
					<i class="fa fa-{{ config('br.actions.'. $item->provider .'.'. $item->reason .'.icon') }}"></i>
					@endunless

					<strong>{{ trans("app.actions_done.$item->reason") }}</strong>

					@unless($item->reward)
					<a href="{{ $item->link }}" target="_blank">
						{{ $item->text }}
					</a>
					@endunless

					<div title="{{ $item->updated_at }}">
						<i class="fa fa-clock-o"></i>
						<small>{{ (new Carbon\Carbon($item->updated_at))->diffForHumans() }}</small>
					</div>
				</li>
				@endforeach
			</ul>
			{{-- <a href="#">@lang('app.show_older')</a> --}}
		</div>
	</div>

	<div class="col-sm-4">
		<div class="scrollable" data-height="195">
			<ul class="list-group">
				@foreach($reduced as $item)
				<li class="list-group-item">
					<span class="badge badge-primary">
						-{{ $item->reward }}
					</span>

					<i class="fa-fw {{ config("br.actions.{$item->provider}.icon") }}"></i>
					<i class="fa-fw fa fa-{{ config("br.actions.{$item->provider}.{$item->reason}.icon") }}"></i>

					<a href="{{ action('UserController@show', $item->user_id) }}">{{ $item->name }}</a>
					@lang("app.actions_done.$item->reason")

					<a href="#">{{ $item->text }}</a>

					<div>
						<i class="fa fa-clock-o"></i>
						<small>{{ (new Carbon\Carbon($item->updated_at))->diffForHumans() }}</small>
					</div>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>
@endif

<div class="row">
	<div class="col-sm-5 profile {{ $user->email ? '' : 'error' }}">
		<h2>
			<i class="fa fa-pencil-square-o"></i>
			@lang('app.profile')
		</h2>

		@if(!$user->name)
		<div class="alert alert-danger">@lang('app.name_required')</div>
		@endif

		@if(!$user->email)
		<div class="alert alert-danger">@lang('app.email_required')</div>
		@endif

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
				{!! Form::label('password', trans('app.password'), ['class' => 'col-sm-3 control-label']) !!}
				<div class="col-sm-9">
					<input type="password" name="password" class="form-control input-lg" placeholder="@lang('app.password_change')">
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
				<div class="tile-stats tile-aqua">
					<div class="icon"><i class="{{ config("br.actions.{$provider->provider}.icon") }}"></i></div>
					<div class="num">
						<div class="row">
							<div class="col-sm-8">
								{{ trans("app.providers.$provider->provider") }}
							</div>
							<div class="col-sm-4">
								<a class="detach btn btn-white btn-block" href="{{ action('AuthController@getDetach', $provider->provider) }}" title="@lang('app.detach_info')">
									<i class="fa fa-unlink"></i>
								</a>
							</div>
						</div>
					</div>
					<div>
						<img class="img-circle" width="40" height="40" src="{{ $provider->user_data->avatar }}" style="float: left; margin-right: 1em;">

						<h3>{{ $provider->user_data->name }}</h3>

						<p>{{ $provider->user_data->email or trans('app.noemail') }}</p>
					</div>
				</div>
			</div>
			@endforeach

			@foreach(array_diff(array_keys(config('br.actions')), $user->providers) as $newProvider)
			<div class="col-sm-6">
				<a href="{{ action('AuthController@getSocial', $newProvider) }}" class="tile-stats tile-cyan">
					<div class="icon"><i class="{{ config("br.actions.$newProvider.icon") }}"></i></div>
					<div class="num">
						<i class="fa fa-user-plus"></i>
						{{ trans("app.providers.$newProvider") }}
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
