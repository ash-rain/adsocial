<?php namespace App\Services\Social;

use App\Contracts\SocialProvider;

class FacebookProvider implements SocialProvider {
	
	public function getFeed()
	{
		return 'hi from facebook';
	}
}