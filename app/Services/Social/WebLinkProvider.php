<?php namespace App\Services\Social;

use Auth;
use App\Contracts\SocialProvider;
use App\WebLink;

class WebLinkProvider implements SocialProvider {

	public function getFeed()
	{
		return WebLink::all();
	}
}