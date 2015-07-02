@extends('app')

@section('pageClass', 'focus')
@section('title', trans('app.shortener'))

@section('js')
$(function() {
	var modal = $('#shortlinkModal')
	modal.find('.submit').click(function() {
		var url = modal.find("input[name='url']").val()
		$.post('/shorten', { 'url': url }, function() {
			window.location.reload()
		})
	})
})
@stop

@section('content')
<div class="header">
	<h1>
		@lang('app.shortener')
		<a class="btn btn-success" data-toggle="modal" data-target="#shortlinkModal">
				<i class="fa fa-plus"></i>
				@lang('app.shorten_new')
		</a>
	</h1>
</div>

@if(count($shortlinks))
<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th>
				@lang('app.shorten_link')
			</th>
			<th>
				@lang('app.shorten_visits')
			</th>
			<th>
				@lang('app.shorten_url')
			</th>
		</tr>
	</thead>
	<tbody>
	@foreach($shortlinks as $shortlink)
		<tr>
			<td>
				<a href="{{ url($shortlink->hash) }}" target="_blank">
					{{ url($shortlink->hash) }}
				</a>
			</td>
			<td>
				<div class="label label-info">
					{{ $shortlink->visits }}
				</div>
			</td>
			<td>
				<a href="{{ $shortlink->url }}" target="_blank">
					{{ $shortlink->url }}
				</a>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
@else
	@lang('app.shorten_empty')
@endif

@include('modals.shortlink')

@stop
