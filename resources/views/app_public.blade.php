<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
	<head>@include('layout.head')</head>
	<body class="page-body @yield('bodyClass')">
		@yield('content')
		@include('layout.scripts')
	</body>
</html>