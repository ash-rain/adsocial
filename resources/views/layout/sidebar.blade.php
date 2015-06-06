<ul id="main-menu" class="main-menu">

	<li>
		<a href="{{ url('/') }}">
			<i class="fa fa-th"></i>
			@lang('app.home')
		</a>
	</li>
		
	@if(Auth::check())

	@if(in_array('twitter', Auth::user()->providers))
	<li class="root-level">
		<a href="{{ action('HomeController@getFeed', 'twitter') }}">
			<i class="fa fa-twitter"></i>
			Twitter
		</a>
	</li>
	@endif

	@if(in_array('facebook', Auth::user()->providers))
	<li>
		<a href="{{ action('HomeController@getFeed', 'facebook') }}">
			<i class="fa fa-facebook-official"></i>
			Facebook
		</a>
	</li>
	@endif

	@if(in_array('google', Auth::user()->providers))
	<li>
		<a href="{{ action('HomeController@getFeed', 'google') }}">
			<i class="fa fa-google-plus"></i>
			Google+
		</a>
	</li>
	@endif

	@if(!in_array('twitter', Auth::user()->providers))
	<li>
		<a href="{{ action('Auth\AuthController@getSocial', 'twitter') }}">
			<i class="fa fa-plus"></i>
			<i class="fa fa-twitter"></i>
			Connect Twitter
		</a>
	</li>
	@endif

	@if(!in_array('facebook', Auth::user()->providers))
	<li>
		<a href="{{ action('Auth\AuthController@getSocial', 'facebook') }}">
			<i class="fa fa-plus"></i>
			<i class="fa fa-facebook-official"></i>
			Connect Facebook
		</a>
	</li>
	@endif

	@if(!in_array('google', Auth::user()->providers))
	<li>
		<a href="{{ action('Auth\AuthController@getSocial', 'google') }}">
			<i class="fa fa-plus"></i>
			<i class="fa fa-google-plus"></i>
			Connect Google+
		</a>
	</li>
	@endif

	<li class="has-sub">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
			<i class="fa fa-user"></i>
			{{ Auth::user()->name }}
		</a>
		<ul>
			<li>
				<a href="{{ action('UserController@edit', Auth::id()) }}">
					<i class="fa fa-pencil"></i>
					@lang('app.profile')
				</a>
			</li>
			<li>
				<a href="{{ url('/auth/logout') }}">
					<i class="fa fa-sign-out"></i>
					@lang('app.logout')
				</a>
			</li>
		</ul>
	</li>
	@endif
</ul>