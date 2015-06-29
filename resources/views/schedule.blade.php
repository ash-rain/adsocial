@extends('app')

@section('pageClass', 'scheduler')

@section('js')
$(function() {
	var calendar = $('#calendar');
	calendar.fullCalendar({
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
		eventStartEditable: true,
    eventLimit: true,
		firstDay: 1,
		timeFormat: 'H(:mm)',
		eventRender: function (event, element, view) {
			if(event.title.length > 16)
				$(element).attr('title', event.title);
		},
    eventClick: function (event) {
      window.open(event.link)
    },
    eventDrop: function (event, delta, revertFunc) {
        if (moment().diff(event.start.toString()) > 0) {
          return revertFunc(); // we may long for the past but those days are gone
        }

        if (!confirm("Delete original post?")) {
          revertFunc();
        } else {
					$.post('/api/v1/post/'+event.id, {'_method':'DELETE'});
				}

				var data = {
					text: event.title,
					link: event.link,
					image: event.image,
					provider: event.provider
				};
				
				$.post('/api/v1/post', data, function() {
					console.log( calendar.fullCalendar('refetchEvents') );
				});
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
