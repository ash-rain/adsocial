<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class CheckUser {

	protected $auth;

	public function __construct(Guard $auth) {
		$this->auth = $auth;
	}

	public function handle($request, Closure $next)
	{
		if(!$this->auth->check()
			|| !$this->auth->user()->email
			|| !$this->auth->user()->name) {
				return redirect()->action('UserController@edit');
		}

		return $next($request);
	}

}
