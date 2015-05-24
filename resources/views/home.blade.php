@extends('app')

@section('content')
<div class="container">
	<div class="panel-body">
		<ul class="list-group">
		@foreach ($market as $id => $actions)
			<li class="list-group-item">
				@foreach ($actions as $action)
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
	</div>
</div>
@endsection
