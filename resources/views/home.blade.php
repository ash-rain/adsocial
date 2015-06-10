@extends('app')

@section('content')

@if(count($market))
<div>
	<div class="market row">
		@foreach($market as $id => $actions)
		<div class="col-md-3">
			<div class="market-item tile-block tile-aqua">
				<div class="tile-header">
					<i class="{{ config('adsocial.provider_icons.'. $actions->first()->provider) }}"></i>
					<a href="#">
						{{ $actions->first()->user->name }}
						<span>{{ $actions->first()->provider }}</span>
					</a>
				</div>
				<div class="tile-content">
					<p>{{ $actions->first()->post->text }}</p>
					<img src="{{ $actions->first()->post->image }}">
				</div>
				<div class="tile-footer">
					@foreach(config('adsocial.trade_actions.' . $actions->first()->provider) as $actionKey => $defaultReward)
					<div class="action">
						<a target="_blank" href="{{ action('HomeController@getAction', [$actions->first()->post_id, $actionKey]) }}" class="btn btn-primary btn-block btn-icon icon-left" title="{{ ucfirst($actionKey) }}">
							<i class="fa fa-{{ config('adsocial.action_icons.' . $actionKey) }}"></i>
							{{ ucfirst($actionKey) }}
							@if(isset($actions[$actionKey]))
							<strong class="label label-success pull-right">
								+{{ $actions[$actionKey]->reward }}
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
	@lang('trade.market_empty')
@endif

@stop

@section('js')
$(function() {
	$('.market-item:gt(3)').each(function() {
		console.log($(this).offset(), $(this).prevAll())
	})
})
@stop