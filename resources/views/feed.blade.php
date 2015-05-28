@extends('app')

@section('content')

@include('modals.boost')

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
			<div class="row">
			@foreach($feed as $item)
			<div class="col-md-3">
				@include("feed/$provider", compact('item', 'provider'))
			</div>
			@endforeach
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