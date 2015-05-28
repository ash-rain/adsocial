<div class="tile-title tile-cyan">
	<div class="icon">
		<a type="button" class="btn {{ isset($market[$item->id]) ? 'btn-primary' : 'btn-default' }}" data-toggle="modal" data-target="#boostModal" data-id="{{ $item->id }}" data-provider="{{ $provider }}">
			<span class="glyphicon glyphicon-flash"></span>
			{{ trans('post.boost') }}
		</a>
	</div>
	<div class="title">
		<h3>{{ $provider }}</h3>
		<p>@yield('item')</p>
	</div>
</div>