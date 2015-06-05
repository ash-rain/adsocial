<div class="navbar-brand">
	<a href="{{ url('/') }}">AdSocial</a>
</div>

<ul class="navbar-nav">
	<li><a href="{{ url('/') }}">Home</a></li>
	@if(Auth::check())
	<li>
		@if(in_array('twitter', Auth::user()->providers))
		<a href="{{ action('HomeController@getFeed', 'twitter') }}">My Twitter</a>
		@else
		<a href="{{ action('Auth\AuthController@getSocial', 'twitter') }}">Connect Twitter</a>
		@endif
	</li>
	<li>
		@if(in_array('facebook', Auth::user()->providers))
		<a href="{{ action('HomeController@getFeed', 'facebook') }}">My Facebook</a>
		@else
		<a href="{{ action('Auth\AuthController@getSocial', 'facebook') }}">Connect Facebook</a>
		@endif
	</li>
	<li>
		@if(in_array('google', Auth::user()->providers))
		<a href="{{ action('HomeController@getFeed', 'google') }}">My Google+</a>
		@else
		<a href="{{ action('Auth\AuthController@getSocial', 'google') }}">Connect Google+</a>
		@endif
	</li>
	@endif
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