<?php namespace App\Services\Social;

use Auth;
use Cache;
use App\Contracts\SocialProvider;
use Google_Client;
use Google_Service_Plus;
use Google_Auth_AssertionCredentials;

class GoogleProvider implements SocialProvider {

	public function getFeed()
	{
		$providerData = Auth::user()->oauth_data()->whereProvider('google')->first();

		$client = new Google_Client();
		$client->setApplicationName('AdSocial');
		$service = new Google_Service_Plus($client);
		
		if(Cache::has('service_token')) {
			$client->setAccessToken(Cache::get('service_token'));
		}

		$key = file_get_contents(storage_path(env('GOOGLE_SERVICE_KEY')));
		$scopes = array('https://www.googleapis.com/auth/plus.login', 'https://www.googleapis.com/auth/plus.me');
		$cred = new Google_Auth_AssertionCredentials(env('GOOGLE_SERVICE_EMAIL'), $scopes, $key);

		$client->setAssertionCredentials($cred);
		if($client->getAuth()->isAccessTokenExpired()) {
			$client->getAuth()->refreshTokenWithAssertion($cred);
		}
		Cache::forever('service_token', $client->getAccessToken());

		$activities = $service->activities->listActivities($providerData->provider_id, 'public');
		return $activities['items'];
	}
}