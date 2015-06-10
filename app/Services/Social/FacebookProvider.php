<?php namespace App\Services\Social;

use Auth;
use App\Contracts\SocialProvider;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use App\Post;

class FacebookProvider extends AbstractProvider implements SocialProvider {
	
	protected $provides = 'facebook';
	protected $fieldMap = [
		'text' => ['story', 'type'],
		'link' => 'link',
		'image' => 'picture',
		'posted_at' => 'created_time'
	];

	public function __construct()
	{
		FacebookSession::setDefaultApplication(
			config('services.facebook.client_id'),
			config('services.facebook.client_secret')
			);

		$this->session = new FacebookSession($this->providerData()->token);
	}

	public function getFeed()
	{
		$url = '/'. $this->providerData()->provider_id .'/feed';
		$request = new FacebookRequest($this->session, 'GET', $url);
		$response = $request->execute();
		$graphObject = $response->getGraphObject();
		return $graphObject->asArray()['data'];
	}

	
	public function getPost($id)
	{
		$request = new FacebookRequest($this->session, 'GET', "/$id?date_format=U");
		$response = $request->execute();
		$graphObject = $response->getGraphObject();
		return $graphObject->asArray();
	}

	public function actionLike($id)
	{
		$request = new FacebookRequest($this->session, 'POST', "/$id/likes");
		$response = $request->execute();
		$graphObject = $response->getGraphObject();
		return $graphObject->getProperty('success');
	}

	public function actionShare($id) {
		$post = Post::whereProviderId($id)->first();
		$request = new FacebookRequest($this->session, 'POST', '/me/feed', ['link' => $post->link]);
		$response = $request->execute();
		$graphObject = $response->getGraphObject();
		return $graphObject->getProperty('success');
	}
}