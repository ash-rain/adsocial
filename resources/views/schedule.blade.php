@extends('app')

@section('content')

<h1>@lang('app.schedule')</h1>

<div class="calendar-env">

	<!-- Calendar Body -->
	<div class="calendar-body">
		<div id="calendar"></div>
	</div>

	<!-- Sidebar -->
	<div class="calendar-sidebar">
		<!-- new task form -->
		<div class="calendar-sidebar-row">
			<form role="form" id="add_event_form">
				<div class="input-group minimal">
					<input type="text" class="form-control" placeholder="Add event..." />
					<div class="input-group-addon">
						<i class="fa fa-pencil"></i>
					</div>
				</div>
			</form>
		</div>

		<!-- Events List -->
		<ul class="events-list" id="draggable_events">
			<li>
				<p>Drag Events to Calendar Dates</p>
			</li>
			<li>
				<a href="#">Sport Match</a>
			</li>
			<li>
				<a href="#" class="color-blue" data-event-class="color-blue">Meeting</a>
			</li>
			<li>
				<a href="#" class="color-orange" data-event-class="color-orange">Relax</a>
			</li>
			<li>
				<a href="#" class="color-primary" data-event-class="color-primary">Study</a>
			</li>
			<li>
				<a href="#" class="color-green" data-event-class="color-green">Family Time</a>
			</li>
		</ul>
	</div>
</div>

@stop
