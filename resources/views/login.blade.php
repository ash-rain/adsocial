@extends('app_public')

@section('title', 'Log In')
@section('bodyClass', 'login-page login-form-fall')

@section('content')
<div class="login-container">
	<div class="login-header login-caret">
		<div class="login-content">
			<a href="{{ url('/') }}" class="logo">
				<h1>
					<i class="fa fa-user"></i>
					@lang('app.title')
				</h1>
			</a>
			<p class="description">
				@lang('app.get_started_text')
				<br><br>
			</p>

			<div class="login-progressbar-indicator">
				<h3>0%</h3>
				<span>logging in...</span>
			</div>

			<form action="{{ action('UserController@store') }}" method="POST">
				<div class="form-group">
					<input type="email" class="form-control input-lg" name="email" placeholder="@lang('app.email')" autocomplete="off" required>
				</div>
				<div class="form-group">
					<input type="password" class="form-control input-lg" name="password" placeholder="@lang('app.password')" autocomplete="off" required>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-lg btn-success btn-icon btn-block btn-login">
						<i class="fa fa-chevron-right"></i>
						@lang('app.get_started')
					</button>
				</div>
			</form>
		</div>
	</div>

	<div class="login-progressbar"><div></div></div>

	<div class="login-form">
		<div class="login-content">
			<div class="form-group">
				<a href="{{ action('AuthController@getSocial', 'facebook') }}" class="btn btn-default btn-lg btn-block btn-icon icon-left facebook-button">
					Login with Facebook
					<i class="fa fa-facebook-official"></i>
				</a>
			</div>
			<div class="form-group">
				<a href="{{ action('AuthController@getSocial', 'twitter') }}" class="btn btn-default btn-lg btn-block btn-icon icon-left twitter-button">
					Login with Twitter
					<i class="fa fa-twitter"></i>
				</a>
			</div>
			<div class="form-group">
				<a href="{{ action('AuthController@getSocial', 'google') }}" class="btn btn-default btn-lg btn-block btn-icon icon-left google-button">
					Login with Google+
					<i class="fa fa-google-plus"></i>
				</a>
			</div>
			<div class="form-group">
				<a href="{{ action('AuthController@getSocial', 'linkedin') }}" class="btn btn-default btn-lg btn-block btn-icon icon-left twitter-button">
					Login with LinkedIn
					<i class="fa fa-linkedin"></i>
				</a>
			</div>
		</div>
	</div>
</div>
@stop

@section('js')
var neonLogin = neonLogin || {};
console.log(neonLogin)
;(function($, window, undefined)
{
"use strict";

$(document).ready(function()
{
	neonLogin.$body = $(".login-page");
	neonLogin.$login_progressbar_indicator = $(".login-progressbar-indicator h3");
	neonLogin.$login_progressbar = neonLogin.$body.find(".login-progressbar div");

	neonLogin.$login_progressbar_indicator.html('0%');

	if(neonLogin.$body.hasClass('login-form-fall'))
	{
		var focus_set = false;

		setTimeout(function(){
			neonLogin.$body.addClass('login-form-fall-init')

			setTimeout(function()
			{
				if( !focus_set)
				{
					neonLogin.$container.find('input:first').focus();
					focus_set = true;
				}

			}, 550);

		}, 0);
	}
	else
	{
		neonLogin.$container.find('input:first').focus();
	}

	// Focus Class
	neonLogin.$container.find('.form-control').each(function(i, el)
	{
		var $this = $(el),
			$group = $this.closest('.input-group');

		$this.prev('.input-group-addon').click(function()
		{
			$this.focus();
		});

		$this.on({
			focus: function()
			{
				$group.addClass('focused');
			},

			blur: function()
			{
				$group.removeClass('focused');
			}
		});
	});

	// Functions
	$.extend(neonLogin, {
		setPercentage: function(pct, callback)
		{
			pct = parseInt(pct / 100 * 100, 10) + '%';

			// Lockscreen
			if(is_lockscreen)
			{
				neonLogin.$lockscreen_progress_indicator.html(pct);

				var o = {
					pct: currentProgress
				};

				TweenMax.to(o, .7, {
					pct: parseInt(pct, 10),
					roundProps: ["pct"],
					ease: Sine.easeOut,
					onUpdate: function()
					{
						neonLogin.$lockscreen_progress_indicator.html(o.pct + '%');
						drawProgress(parseInt(o.pct, 10)/100);
					},
					onComplete: callback
				});
				return;
			}

			// Normal Login
			neonLogin.$login_progressbar_indicator.html(pct);
			neonLogin.$login_progressbar.width(pct);

			var o = {
				pct: parseInt(neonLogin.$login_progressbar.width() / neonLogin.$login_progressbar.parent().width() * 100, 10)
			};

			TweenMax.to(o, .7, {
				pct: parseInt(pct, 10),
				roundProps: ["pct"],
				ease: Sine.easeOut,
				onUpdate: function()
				{
					neonLogin.$login_progressbar_indicator.html(o.pct + '%');
				},
				onComplete: callback
			});
		},

		resetProgressBar: function(display_errors)
		{
			TweenMax.set(neonLogin.$container, {css: {opacity: 0}});

			setTimeout(function()
			{
				TweenMax.to(neonLogin.$container, .6, {css: {opacity: 1}, onComplete: function()
				{
					neonLogin.$container.attr('style', '');
				}});

				neonLogin.$login_progressbar_indicator.html('0%');
				neonLogin.$login_progressbar.width(0);

				if(display_errors)
				{
					var $errors_container = $(".form-login-error");

					$errors_container.show();
					var height = $errors_container.outerHeight();

					$errors_container.css({
						height: 0
					});

					TweenMax.to($errors_container, .45, {css: {height: height}, onComplete: function()
					{
						$errors_container.css({height: 'auto'});
					}});

					// Reset password fields
					neonLogin.$container.find('input[type="password"]').val('');
				}

			}, 800);
		}
	});
});

})(jQuery, window);
@stop
