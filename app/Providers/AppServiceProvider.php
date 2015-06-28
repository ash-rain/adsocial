<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	public function boot() {
		view()->composer([
			'checkout.done',
			'checkout.cancel',
			'feed',
			'home',
			'profile',
			'profile_edit',
			'schedule',
		], 'App\Http\ViewComposer');
	}

	public function register() {
	}

}
