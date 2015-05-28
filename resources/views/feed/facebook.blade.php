@extends('feed._base')

@section('item')
<div>
	@if(isset($item->link))
	<a href="{{ $item->link }}">
	@endif
		{{ $item->story or $item->type }}
	@if(isset($item->link))
	</a>
	@endif
</div>

<div class="label label-default">
	{{ Carbon\Carbon::createFromTimeStamp(strtotime($item->created_time))->diffForHumans() }}
</div>
@stop