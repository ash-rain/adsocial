<!DOCTYPE html>
<html lang="en">
<head>@include('layout.head')</head>
<body class="page-body">
	<div class="page-container">
		<div class="sidebar-menu fixed">
			<div class="sidebar-menu-inner ps-container ps-active-y">
				<header class="logo-env">
					<div class="logo">
						<a href="{{ url('/') }}">@lang('app.title')</a>
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

				<div class="user-info">
					<a href="{{ url('me') }}">
						<img src="{{ $user->avatar }}">
					</a>
					<div class="info">
						<span class="name">
							<a href="{{ url('me') }}">{{ $user->name }}</a>
						</span>
						<span class="points">
							{{ $user->points }}
						</span>
					</div>
				</div>

				@include('layout.sidebar')
			</div>
		</div>
		<div class="@yield('pageClass') main-content">
			@yield('content')
		</div>
	</div>
	@include('modals.post')
	@include('layout.scripts')
</body>
</html>
