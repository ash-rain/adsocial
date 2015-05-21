<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ url('/') }}">AdSocial</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="{{ url('/') }}">Home</a></li>
				@if(Auth::check())
				<li>
					@if(in_array('twitter', Auth::user()->providers))
					<a href="{{ action('HomeController@getFeed', 'twitter') }}">Twitter</a>
					@else
					<a href="{{ action('Auth\AuthController@getSocial', 'twitter') }}">Connect Twitter</a>
					@endif
				</li>
				<li>
					@if(in_array('facebook', Auth::user()->providers))
					<a href="{{ action('HomeController@getFeed', 'facebook') }}">Facebook</a>
					@else
					<a href="{{ action('Auth\AuthController@getSocial', 'facebook') }}">Connect Facebook</a>
					@endif
				</li>
				<li>
					@if(in_array('google', Auth::user()->providers))
					<a href="{{ action('HomeController@getFeed', 'google') }}">Google+</a>
					@else
					<a href="{{ action('Auth\AuthController@getSocial', 'google') }}">Connect Google+</a>
					@endif
				</li>
				@endif
			</ul>

			<ul class="nav navbar-nav navbar-right">
				@if (Auth::guest())
					<li><a href="{{ url('/auth/login') }}">Login</a></li>
					<li><a href="{{ url('/auth/register') }}">Register</a></li>
				@else
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
						</ul>
					</li>
				@endif
			</ul>
		</div>
	</div>
</nav>