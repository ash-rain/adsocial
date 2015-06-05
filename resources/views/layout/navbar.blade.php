<div class="navbar-brand">
	<a href="{{ url('/') }}">AdSocial</a>
</div>

<ul class="navbar-nav">
	
</ul>

<ul class="nav navbar-right pull-right">
	@if (Auth::guest())
		<li><a href="{{ url('/auth/login') }}">Login</a></li>
		<li><a href="{{ url('/auth/register') }}">Register</a></li>
	@else
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
				{{ Auth::user()->name }}
				<span class="caret"></span>
			</a>
			<ul class="dropdown-menu" role="menu">
				<li><a href="{{ action('UserController@edit', Auth::id()) }}">My Profile</a></li>
				<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
			</ul>
		</li>
	@endif
</ul>