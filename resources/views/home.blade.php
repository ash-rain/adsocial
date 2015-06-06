@extends('app')

@section('content')

@if(count($market))
<div class="row">
	@foreach($market as $id => $actions)
	<div class="col-sm-3">
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
					<button type="button" class="btn btn-green btn-block btn-icon icon-left" title="{{ ucfirst($actionKey) }}">
						<i class="fa fa-{{ config('adsocial.action_icons.' . $actionKey) }}"></i>
						{{ ucfirst($actionKey) }}
						@if(isset($actions[$actionKey]))
						<span class="badge badge-success pull-right">+{{ $actions[$actionKey]->reward }}</span>
						@endif
					</button>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	@endforeach
</div>
@else
	@lang('trade.market_empty')
@endif

@endsection
