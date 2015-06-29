@extends('app')

@section('pageClass', 'scheduler')

@section('js')
$(function() {
	$('#calendar').fullCalendar({
    eventSources: [
      {
        url: '/api/v1/post',
        data: { provider: 'google' },
        className: 'google'
      },
      {
        url: '/api/v1/post',
				data: { provider: 'facebook' },
        className: 'facebook'
      },
      {
        url: '/api/v1/post',
				data: { provider: 'twitter' },
        className: 'twitter'
      }
    ],
		events: {
				cache: true
		},
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		editable: true,
    eventLimit: true,
		forceEventDuration: true,
		defaultTimedEventDuration: "03:00:00",
		timeFormat: 'H(:mm)',
		eventRender: function (event, element, view) {
			$(element).attr('title', event.title);
		},
    eventClick: function (event) {
      console.log(event)
    },
    eventDrop: function (event, delta, revertFunc) {
        if (moment().diff(event.start.toString()) > 0) {
          return revertFunc();
        }
        if (!confirm("Are you sure about this change?")) {
          revertFunc();
        }
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
