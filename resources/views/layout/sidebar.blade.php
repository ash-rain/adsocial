<ul id="main-menu" class="main-menu">

	<li>
		<a href="{{ url('/') }}">
			<i class="fa fa-th"></i>
			Home
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
	<li>
		@if(in_array('twitter', Auth::user()->providers))
		<a href="{{ action('HomeController@getFeed', 'twitter') }}">
			<i class="fa fa-user"></i>
			<i class="fa fa-twitter"></i>
			My Twitter
		</a>
		@else
		<a href="{{ action('Auth\AuthController@getSocial', 'twitter') }}">
			<i class="fa fa-plus"></i>
			<i class="fa fa-twitter"></i>
			Connect Twitter
		</a>
		@endif
	</li>

	@if(in_array('facebook', Auth::user()->providers))
	<li>
		<a href="{{ action('HomeController@getFeed', 'facebook') }}">
			<i class="fa fa-facebook-official"></i>
			Facebook
		</a>
	</li>
	@endif

	<li>
		@if(in_array('facebook', Auth::user()->providers))
		<a href="{{ action('HomeController@getFeed', 'facebook') }}">
			<i class="fa fa-user"></i>
			<i class="fa fa-facebook-official"></i>
			My Facebook
		</a>
		@else
		<a href="{{ action('Auth\AuthController@getSocial', 'facebook') }}">
			<i class="fa fa-plus"></i>
			<i class="fa fa-facebook-official"></i>
			Connect Facebook
		</a>
		@endif
	</li>

	@if(in_array('google', Auth::user()->providers))
	<li>
		<a href="{{ action('HomeController@getFeed', 'google') }}">
			<i class="fa fa-google-plus"></i>
			Google+
		</a>
	</li>
	@endif

	<li>
		@if(in_array('google', Auth::user()->providers))
		<a href="{{ action('HomeController@getFeed', 'google') }}">
			<i class="fa fa-user"></i>
			<i class="fa fa-google-plus"></i>
			My Google+
		</a>
		@else
		<a href="{{ action('Auth\AuthController@getSocial', 'google') }}">
			<i class="fa fa-plus"></i>
			<i class="fa fa-google-plus"></i>
			Connect Google+
		</a>
		@endif
	</li>
	@endif
</ul>