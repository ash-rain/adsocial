<ul id="main-menu" class="main-menu">
	<li class="{{ Request::is('/') ? 'active' : '' }}">
		<a href="{{ url('/') }}">
			<i class="fa fa-th"></i>
			<label>@lang('app.home')</label>
		</a>
	</li>

	@if($user)

	@foreach(config('br.actions') as $provider => $settings)
		@if(!isset($settings['authOnly']) && in_array($provider, $user->providers))
		<li class="{{ Request::is("feed/$provider", "feed/$provider/*") ? 'active' : '' }}">
			<a href="{{ action('SiteController@getFeed', $provider) }}">
				<i class="{{ $settings['icon'] }}"></i>
				<label>@lang("app.providers.$provider")</label>
			</a>
		</li>
		@endif
	@endforeach

	@foreach(config('br.actions') as $provider => $settings)
		@if(!isset($settings['authOnly']) && !in_array($provider, $user->providers))
		<li class="{{ Request::is("feed/$provider", "feed/$provider/*") ? 'active' : '' }}">
			<a href="{{ action('AuthController@getSocial', $provider) }}">
				<i class="fa fa-plus-circle"></i>
				<label>@lang("app.providers.$provider")</label>
			</a>
		</li>
		@endif
	@endforeach

	<li class="has-sub opened {{ Request::is('me', 'me/*') ? 'active' : '' }}">
		<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
			<i class="fa fa-user"></i>
			<label>{{ $user->name }}</label>
		</a>
		<ul>
			<li>
				<a href="#" data-toggle="modal" data-target="#postModal" >
					<i class="fa fa-plus"></i>
					<label>@lang('app.post_new')</label>
				</a>
			</li>
			<li class="{{ Request::is('schedule', 'schedule/*') ? 'active' : '' }}">
				<a href="{{ action('ScheduleController@getIndex') }}">
					<i class="fa fa-clock-o"></i>
					<label>@lang('app.schedule')</label>
				</a>
			</li>
			<li class="{{ Request::is('shorten') ? 'active' : '' }}">
				<a href="{{ action('ShortenController@getIndex') }}">
					<i class="fa fa-compress"></i>
					<label>@lang('app.shortener')</label>
				</a>
			</li>
			<li class="{{ Request::is('me') ? 'active' : '' }}">
				<a href="{{ action('UserController@edit') }}">
					<i class="fa fa-pencil"></i>
					<label>@lang('app.profile')</label>
				</a>
			</li>
			</li>
			<li>
				<a href="{{ action('AuthController@getLogout') }}">
					<i class="fa fa-sign-out"></i>
					<label>@lang('app.logout')</label>
				</a>
			</li>
		</ul>
	</li>
	@endif
</ul>
