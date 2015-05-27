@extends('app')

@section('content')
<div class="container">
	<div class="panel-body">
		@if(count($market))
		<ul class="list-group">
		@foreach ($market as $id => $actions)
			<li class="list-group-item">
				@foreach (conf('adsocial.trade_actions.' . $actions[0]->provider) as $action => $default)
				<a class="btn btn-default">
					{{ $action->action }}
					{{ $action->reward }}
				</a>
				@endforeach
				<span class="label label-default">{{ $actions[0]->provider }}</span>
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
