<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	public function boot() {
		view()->composer(['home', 'feed', 'profile', 'profile_edit'], 'App\Http\ViewComposer');
	}

	public function register() {
	}

}
