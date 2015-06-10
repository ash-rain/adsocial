<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	public function boot() {
		view()->composer('app', 'App\Http\ViewComposer');
	}

	public function register() {
	}

}
