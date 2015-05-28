@extends('app')

@section('content')
<div class="container">
	<div class="panel-body">
		@if(count($market))
		<ul class="list-group">
		@foreach($market as $id => $item)
			<li class="list-group-item">
				<span class="label label-default">{{ $item->first()->provider }}</span>
				@foreach(config('adsocial.trade_actions.' . $item->first()->provider) as $actionKey => $defaultReward)
				<a class="btn btn-default" title="{{ ucfirst($actionKey) }}">
					<i class="glyphicon glyphicon-{{ config('adsocial.action_icons.' . $actionKey) }}"></i>
					@if(isset($item[$actionKey]))
					<span class="label label-success">+{{ $item[$actionKey]->reward }}</span>
					@endif
				</a>
				@endforeach
				{{ $id }}
			</li>
		@endforeach
		</ul>
		@else
		{{ trans('trade.market_empty') }}
		@endif
	</div>
</div>
@endsection
