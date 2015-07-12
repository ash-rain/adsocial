@extends('app')

@section('pageClass', 'focus')

@section('js')
$(function() {
	var calendar = $('#calendar');
	calendar.fullCalendar({
	eventSources: [
	  { url: '/api/v1/post', data: { provider: 'google' }, className: 'google' },
	  { url: '/api/v1/post', data: { provider: 'facebook' }, className: 'facebook' },
	  { url: '/api/v1/post', data: { provider: 'twitter' }, className: 'twitter' },
	  { url: '/api/v1/post', data: { provider: 'weblink' }, className: 'weblink' }
	],
	events: { cache: true },
	header: {
		left: 'prev,next today',
		center: 'title',
		right: 'month,agendaWeek,agendaDay'
	},
	eventStartEditable: true,
	eventLimit: true,
	firstDay: 1,
	timeFormat: 'H(:mm)',
	eventRender: function (event, element, view) {
		if(event.title.length > 16) $(element).attr('title', event.title);
	},
	eventClick: function (event) {
		if(event.link) window.open(event.link)
	},
	eventDrop: function (event, delta, revertFunc) {
		var s = jQuery.extend(true, {}, event.start);
		if (moment().diff(s) > 0) {
			return revertFunc(); // no dropping in the past
		}
		if (moment().diff(s.subtract(delta)) > 0) {
			return revertFunc(); // also no dropping from the past thank you very much
		}

		event.start.add(delta)

		$.post(
			('/api/v1/post/' + event.id + '/reschedule'),
			{ 'posted_at': (event.start.format('x') / 1000) },
			function(r) {
				console.log( r )
				calendar.fullCalendar('refetchEvents');
			}
		);
	}
	});
});
@stop

@section('content')
<div class="header">
	<h1>
		@lang('app.schedule')
		<a class="btn btn-success" data-toggle="modal" data-target="#postModal">
				<i class="fa fa-plus"></i>
				@lang('app.post_new')
		</a>
	</h1>
</div>
<div id="calendar"></div>
@stop
