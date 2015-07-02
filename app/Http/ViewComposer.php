<?php namespace App\Http;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Auth\Guard;
use Cache;
use App\Category;

class ViewComposer {

	public function __construct(Guard $auth) {
		$this->auth = $auth;
	}

	public function compose(View $view)
	{
		$categories = Cache::remember('categories', 1440, function() {
			return Category::orderBy('name')->get();
		});

		$view->with([
			'user' => $this->auth->user(),
			'categories' => $categories,
			'guest' => !$this->auth->check()
		]);
	}
}
