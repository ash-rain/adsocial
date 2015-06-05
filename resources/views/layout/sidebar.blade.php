<ul id="main-menu" class="main-menu">
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
</ul>