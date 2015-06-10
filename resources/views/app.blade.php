<!DOCTYPE html>
<html lang="en">
<head>@include('layout.head')</head>
<body class="page-body">
	<div class="page-container">
		<div class="sidebar-menu fixed">
			<div class="sidebar-menu-inner ps-container ps-active-y">
				<header class="logo-env">
					<div class="logo">
						<a href="{{ url('/') }}">
							AdSocial
						</a>
					</div>
					<div class="sidebar-collapse">
						<a href="#" class="sidebar-collapse-icon">
							<i class="fa fa-fw fa-bars"></i>
						</a>
					</div>
					<div class="sidebar-mobile-menu visible-xs">
						<a href="#" class="with-animation">
							<i class="fa fa-fw fa-bars"></i>
						</a>
					</div>
				</header>
				@include('layout.sidebar')
			</div>
		</div>
		<div class="main-content">
			@yield('content')
		</div>
	</div>
	@include('layout.scripts')
</body>
</html>
