@extends('app')

@section('content')

@if(count($market))
<div>
	<div class="market row">
		@foreach($market as $id => $actions)
		<div class="col-md-3">
			<div class="market-item tile-block tile-gray">
				<div class="tile-header">
					<i class="{{ config('adsocial.actions.'. $actions->first()->provider . '.icon') }}"></i>
					@if($actions->first()->user->id == $user->id)
					<a href="#">
						<i class="fa fa-pencil-square-o"></i>
					</a>
					@endif
					<a href="{{ action('UserController@show', $actions->first()->user->id) }}">
						{{ $actions->first()->user->name }}
						<span>{{ $actions->first()->provider }}</span>
					</a>
				</div>
				@if($actions->first()->post->image)
				<div class="tile-content image" style="background-image: url({{ $actions->first()->post->image }})">
					<p>{{ $actions->first()->post->text }}</p>
				</div>
				@else
				<div class="tile-content">
					<p>{{ $actions->first()->post->text }}</p>
				</div>
				@endif
				<div class="tile-footer">
					@foreach(config('adsocial.actions.' . $actions->first()->provider) as $action => $settings)
					<?php if(!is_array($settings)) continue; ?>
					<div class="action">
						<a target="_blank" href="{{ action('SiteController@getAction', [$actions->first()->post_id, $action]) }}" class="btn btn-primary btn-block btn-icon icon-left" title="@lang("app.actions.$action")">
							<i class="fa fa-{{ $settings['icon'] }}"></i>
							@lang("app.actions.$action")
							@if(isset($actions[$action]))
							<strong class="label label-success pull-right">
								+{{ $actions[$action]->reward }}
							</strong>
							@endif
						</a>
					</div>
					@endforeach
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
@else
	@lang('app.market_empty')
@endif

@stop

@section('js')
$(function() {
	$('.market-item:gt(3)').each(function() {
		console.log($(this).offset(), $(this).prevAll())
	})
})
@stop