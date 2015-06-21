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
		'app.css'
	], 'public/style.css');
	
	mix.scripts([
		'gsap/main-gsap.js',
		'joinable.js',
		'resizeable.js',
		'neon-api.js',
		'bootstrap-datepicker.js',
		'bootstrap-timepicker.min.js',
		'select2/select2.min.js',
		'neon-custom.js'
	], 'public/vendor.js');
});