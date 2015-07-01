@extends('app')

@section('content')

<ul class="cbp_tmtimeline">
	<li>
		<div class="cbp_tmicon">
			<img src="{{ $providerUser->avatar }}" class="img-responsive img-circle" />
		</div>
		<div class="cbp_tmlabel header">
			<ul class="list-inline">
				<li>
					<h3>{{ $providerUser->name }}</h3>
					<span>{{ $providerUser->email or trans('app.noemail') }}</span>
				</li>
			</ul>
		</div>
	</li>
	<li>
		<div class="cbp_tmlabel header">
			<h2>
				<i class="{{ config("br.actions.$provider.icon") }}"></i>
				{{ ucfirst($provider) }}
			</h2>
		</div>
	</li>
	@foreach($feed as $item)
	<li>
		<time class="cbp_tmtime" title="{{ $item->posted_at->format('d/m H:i') }}">
			<span>{{ $item->posted_at->diffForHumans() }}</span>
		</time>
		<div class="cbp_tmlabel">
			<div class="row">
				<div class="col-sm-9 longtext">
					<blockquote>
						@if($item->link)
						<a href="{{ $item->link }}">
							<h4>{{ strlen($item->text) ? $item->text : $item->link }}</h4>
						</a>
						@else
							<h4>{{ $item->text }}</h4>
						@endif
					</blockquote>

					<div class="meta" style="margin-bottom: 4px;">
					@if($item->meta)
						@include("meta.$provider", compact('item'))
					@endif
					</div>
				</div>
				@if($item->image)
				<div class="col-sm-3">
					<div class="thumbnail-highlight pull-right">
						<img class="img-responsive img-rounded" src="{{ $item->image }}">
					</div>
				</div>
				@endif
			</div>

			<a class="btn btn-icon icon-left {{ $item->market->count() ? 'btn-primary' : 'btn-green' }}"
				data-toggle="modal" data-target="#{{ $provider }}BoostModal" data-post-id="{{ $item->id }}">
				<i class="fa {{ $item->market->count() ? 'fa-cog' : 'fa-plus' }}"></i>
				{{ trans($item->market->count() ? 'app.boosted' : 'app.boost') }}
			</a>

			@if($provider == 'weblink')
			<a class="btn btn-icon icon-left btn-default"
				data-toggle="modal" data-target="#postModal" data-id="{{ $item->id }}">
				<i class="fa fa-pencil"></i>
				@lang('app.post_edit')
			</a>
			@endif
		</div>
	</li>
	@endforeach
</ul>

@include('modals.boost', compact('provider'))
@include('layout.boost-js')

@endsection
