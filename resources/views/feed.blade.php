@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<ul class="list-group">
				@foreach($feed as $item)
				<li class="list-group-item">
					<div class="row">
					<div class="col-md-2">
						<a class="btn btn-default">
							{{ trans('post.boost') }}
						</a>
					</div>
					<div class="col-md-10">
						@include("feed/$provider", compact('item'))
					</div>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>
@endsection
