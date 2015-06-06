<?php namespace App\Services\Social;

use Auth;
use Cache;
use App\Contracts\SocialProvider;
use Google_Client;
use Google_Service_Plus;
use Google_Auth_AssertionCredentials;

class GoogleProvider extends AbstractProvider implements SocialProvider {

	protected $provider = 'google';
	protected $fieldMap = [
		'text' => 'title',
		'link' => 'url',
		'posted_at' => 'published'
	];

	public function __construct()
	{
		$client = new Google_Client();
		$this->service = new Google_Service_Plus($client);
		
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
	}

	public function getFeed()
	{
		$activities = $this->service->activities->listActivities($this->providerData()->provider_id, 'public');
		return $activities['items'];
	}

	public function getPost($id)
	{
		$activity = $this->service->activities->get($id);
		return array_only((array)$activity, ['title', 'published', 'url']);
	}
}