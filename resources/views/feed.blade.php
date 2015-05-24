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
						<button type="button" class="btn {{ isset($market[$item->id]) ? 'btn-primary' : 'btn-default' }}" data-toggle="modal" data-target="#boostModal" data-id="{{ $item->id }}" data-provider="{{ $provider }}">
							<span class="glyphicon glyphicon-flash"></span>
							{{ trans('post.boost') }}
						</button>
						@if(isset($market[$item->id]))
							@foreach($market[$item->id] as $marketItem)
							<div>
							<span class="label label-default">{{ $marketItem->action }}</span>
							{{ $marketItem->reward }}
							</div>
							@endforeach
						@endif
					</div>
					<div class="col-md-10">
						@include("feed/$provider", compact('item'))
					</div>
					</div>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>

<div class="modal fade" id="boostModal" tabindex="-1" role="dialog" aria-labelledby="boostModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="boostModalLabel">Boost Post</h4>
			</div>
			<div class="modal-body">
				<form class="row">
					<input type="hidden" name="provider">
					<input type="hidden" name="provider_id">
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="post panel-body"></div>
						</div>
					</div>
					<div class="col-md-6">
						@foreach(config("adsocial.trade_actions.twitter") as $action => $default)
						<div class="form-group">
							<label>
								<b>{{ trans("trade.$action") }}</b>
								<input type="number" name="{{ $action }}" class="form-control" placeholder="{{ trans('trade.reward') }}" value="{{ $default }}">
								{{ trans('trade.points') }}
							</label>
						</div>
						@endforeach
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.cancel') }}</button>
				<button type="button" class="submit btn btn-primary" data-dismiss="modal">
					{{ trans('trade.boost') }}
				</button>
			</div>
		</div>
	</div>
</div>
@endsection


@section('js')
$(function() {
	$('#boostModal .submit.btn').click(function() {
		$.ajax({
			method: 'POST',
			url: '/api/v1/trade/boost',
			data: $('#boostModal form').serialize(),
			complete: function(){ window.location.reload() }
		})
	})

	$('[data-id]').click(function() {
		var modal = $('#boostModal')
		modal.find('[name="provider"]').val($(this).data('provider'))
		modal.find('[name="provider_id"]').val($(this).data('id'))
		modal.find('.post.panel-body').html($(this).parent().next().html())
	})
})
@stop