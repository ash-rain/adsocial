var elixir = require('laravel-elixir');

elixir(function(mix) {
	mix.styles([
		'neon/bootstrap.css',
		'neon/neon-core.css',
		'neon/neon-theme.css',
		'neon/neon-forms.css',
		'neon/vertical-timeline-component.css',
		'neon/daterangepicker-bs3.css',
		'neon/select2-bootstrap.css',
		'neon/select2.css',
		'neon/fullcalendar.min.css',
		'app.css'
	], 'public/style.css');

	mix.scripts([
		'gsap/main-gsap.js',
		'jquery-ui/js/jquery-ui-1.10.3.minimal.min.js',
		'joinable.js',
		'resizeable.js',
		'neon-api.js',
		'bootstrap-datepicker.js',
		'bootstrap-timepicker.min.js',
		'select2/select2.min.js',
		'fullcalendar-2/fullcalendar.min.js',
		'neon-custom.js'
	], 'public/vendor.js');
});
