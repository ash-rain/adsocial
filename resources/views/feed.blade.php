@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<img src="{{ $providerUser->avatar }}" style="max-height: 50px;" />
			<h2 style="display: inline-block;">{{ $providerUser->name }}</h2>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<ul class="list-group">
				@foreach($feed as $item)
				<li class="list-group-item">
					<div class="row">
					<div class="col-md-2">
						<a class="btn btn-default" data-id="{{ $item->id }}" data-provider="{{ $provider }}">
							<span class="glyphicon glyphicon-flash"></span>
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


@section('js')
$(function() {
	$('[data-id]').click(function() {
		alert($(this).data('provider') + "\n" + $(this).data('id'))
	})
})
@stop