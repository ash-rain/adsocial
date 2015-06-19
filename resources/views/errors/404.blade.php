@extends('app_public')

@section('content')
<div class="page-error-404">
	<div class="error-symbol">
		<i class="fa fa-warning"></i>
	</div>

	<div class="error-text">
		<h2>404</h2>
		<p>Page not found!</p>
	</div>
	
	<hr>
	
	<div class="error-text">
		<a class="btn btn-success btn-icon icon-left btn-lg" href="{{ url('/') }}">
			<i class="fa fa-chevron-left"></i>
			Back to the site
		</a>
	</div>
</div>
@stop