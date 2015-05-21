<?php namespace App\Services\Social;

use Auth;
use Twitter;
use App\Contracts\SocialProvider;

class TwitterProvider implements SocialProvider {

	public function getFeed()
	{
		$providerData = Auth::user()->oauth_data()->whereProvider('twitter')->first();
		return Twitter::getUserTimeline([
			'screen_name' => $providerData->user_data->nickname,
			'count' => 20,
			'format' => 'object'
			]);
	}
}