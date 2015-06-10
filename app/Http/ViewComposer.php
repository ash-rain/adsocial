<?php namespace App\Http;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Auth\Guard;

class ViewComposer {

	public function __construct(Guard $auth) {
		$this->auth = $auth;
	}

	public function compose(View $view)
	{
		$view->with([
			'user' => $this->auth->user(),
			'guest' => !$this->auth->check()
		]);
	}
}