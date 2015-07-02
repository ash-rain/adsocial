<?php namespace App\Http\Controllers;

use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use App\User;
use App\Log;
use App\ShortLink;

class ShortenController extends Controller {

	public function __construct(Guard $auth)
	{
		$this->middleware('auth', ['except' => ['handleShortcode']]);
		$this->auth = $auth;
	}

	public function handleShortcode($hash)
	{
		$shortLink = ShortLink::whereHash($hash)->first();

		if(isset($shortLink->url))
		{
			$shortLink->increment('visits');
			return redirect($shortLink->url);
		}

		return redirect()->back('/');
	}
}
