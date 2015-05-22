<?php namespace App\Services\Social;

use Auth;
use App\Contracts\SocialProvider;
use App\Weblink;

class WeblinkProvider implements SocialProvider {

	public function getFeed()
	{
		return Weblink::all();
	}
}