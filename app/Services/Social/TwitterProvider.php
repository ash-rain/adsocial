<?php namespace App\Services\Social;

use App\Contracts\SocialProvider;

class TwitterProvider implements SocialProvider {

	public function getFeed()
	{
		return 'hi from twitter';
	}
}