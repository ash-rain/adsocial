@extends('app')

@section('content')

@include('modals.boost', compact('provider'))

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
		<span>{{ $item->posted_at->format('d/m H:i') }}</span>
		<span>{{ $item->posted_at->diffForHumans() }}</span>
	</time>
	<div class="cbp_tmicon">
		<i class="fa fa-comment"></i>
	</div>
	<div class="cbp_tmlabel">
		<div class="row">
			<div class="col-sm-9">
				<h3>{{ $item->text }}</h3>	
			</div>
			@if($item->image)
			<div class="col-sm-3" style="text-align: right;">
				<img src="{{ $item->image }}">
			</div>
			@endif
		</div>
		<a class="btn btn-icon icon-left {{ $item->market ? 'btn-primary' : 'btn-green' }}"
			data-toggle="modal" data-target="#boostModal" data-post-id="{{ $item->id }}">
			<i class="fa {{ $item->market ? 'fa-pencil' : 'fa-check' }}"></i>
			{{ trans('post.boost') }}
		</a>
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

	$('[data-post-id]').click(function() {
		var modal = $('#boostModal')
		modal.find('[name="post_id"]').val($(this).data('post-id'))
		modal.find('.post-preview').html($(this).prev().html())
	})
})
@stop