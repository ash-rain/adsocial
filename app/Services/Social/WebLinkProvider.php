<?php namespace App\Services\Social;

use Auth;
use App\Contracts\SocialProvider;
use App\WebLink;

class WebLinkProvider extends AbstractProvider implements SocialProvider {

	public function getFeed()
	{
		return WebLink::all();
	}

	
	public function getPost($id)
	{
		return WebLink::find($id);
	}
}