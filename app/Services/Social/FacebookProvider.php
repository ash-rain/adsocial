<?php namespace App\Services\Social;

use Auth;
use App\Contracts\SocialProvider;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;

class FacebookProvider implements SocialProvider {
	
	public function getFeed()
	{
		$providerData = Auth::user()->oauth_data()->whereProvider('facebook')->first();
		
		FacebookSession::setDefaultApplication(
			config('services.facebook.client_id'),
			config('services.facebook.client_secret')
			);

		$session = new FacebookSession($providerData->token);

		$request = new FacebookRequest($session, 'GET', "/$providerData->provider_id/feed");
		$response = $request->execute();
		$graphObject = $response->getGraphObject();
		
		return $graphObject->asArray()['data'];
	}


	public function getPost($id)
	{

	}
}