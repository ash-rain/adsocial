@extends('app')

@section('content')

@include('modals.boost')

<h1>
	<i class="{{ config("adsocial.provider_icons.$provider") }}"></i>
	{{ ucfirst($provider) }}
</h1>

<ul class="cbp_tmtimeline">
	<li>
		<div class="cbp_tmicon">
			<img src="{{ $providerUser->avatar }}" class="img-responsive img-circle" style="max-height: 80px;" />
		</div>
		<div class="cbp_tmlabel header">
			<ul class="list-inline">
				<li>
					<h3>{{ $providerUser->name }}</h3>
					<span>{{ $providerUser->email or trans('app.no_email') }}</span>
				</li>
				<li>
					<h3>643</h3>
					<span><a href="#">followers</a></span>
				</li>
				<li>
					<h3>108</h3>
					<span><a href="#">following</a></span>
				</li>
			</ul>
		</div>
	</li>
	@foreach($feed as $item)
	<li>
	<time class="cbp_tmtime" datetime="2014-12-09T03:45">
		<span>03:45 AM</span>
		<span>Today</span>
	</time>
	<div class="cbp_tmicon bg-gray">
		<i class="fa fa-comment"></i>
	</div>
	<div class="cbp_tmlabel">
		<h2>
			<a class="btn btn-icon icon-left {{ isset($market[$item->id]) ? 'btn-primary' : 'btn-green' }}" data-toggle="modal" data-target="#boostModal" data-id="{{ $item->id }}" data-provider="{{ $provider }}">
				<i class="fa fa-line-chart"></i>
				{{ trans('post.boost') }}
			</a>
			<a href="#">{{ $providerUser->name }}</a>
			<span>posted a status update</span>
		</h2>
		<p>@include("feed/$provider", compact('item', 'provider'))</p>
	</div>
	</li>
	@endforeach
</ul>


@endsection


@section('js')
$(function() {
	$('#boostModal .submit.btn').on('click', function() {
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