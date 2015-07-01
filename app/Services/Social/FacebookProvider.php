<?php namespace App\Services\Social;

use Auth;
use App\Contracts\SocialProvider;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use App\Contracts\SocialPost;
use App\Post;

class FacebookProvider extends AbstractProvider implements SocialProvider {

	protected $provides = 'facebook';
	protected $fieldMap = [
		'text' => ['story', 'description', 'type'],
		'link' => 'link',
		'image' => 'picture',
		'posted_at' => 'created_time'
	];

	public function __construct()
	{
		parent::__construct();
		FacebookSession::setDefaultApplication(
			config('services.facebook.client_id'),
			config('services.facebook.client_secret')
			);
	}

	public function publish(SocialPost $post)
	{

	}

	private function useSession() {
		$this->session = new FacebookSession($this->providerData()->token);
	}

	public function getFeed()
	{
		$this->useSession();
		$url = '/'. $this->providerData()->provider_id .'/feed';
		$request = new FacebookRequest($this->session, 'GET', $url);
		$response = $request->execute();
		$graphObject = $response->getGraphObject();
		return $graphObject->asArray()['data'];
	}


	public function getPost($id)
	{
		$this->useSession();
		$request = new FacebookRequest($this->session, 'GET', "/$id?date_format=U");
		$response = $request->execute();
		$graphObject = $response->getGraphObject();
		return $graphObject->asArray();
	}

	public function actionLike($id)
	{
		$this->useSession();
		$request = new FacebookRequest($this->session, 'POST', "/$id/likes");
		$response = $request->execute();
		$graphObject = $response->getGraphObject();
		return $graphObject->getProperty('success');
	}

	public function actionShare($id) {
		$this->useSession();
		$post = Post::whereProviderId($id)->first();
		$request = new FacebookRequest($this->session, 'POST', '/me/feed', ['link' => $post->link]);
		$response = $request->execute();
		$graphObject = $response->getGraphObject();
		return $graphObject->getProperty('success');
	}

	public function checkLike($id, $user)
	{
		$this->useSession();
		$request = new FacebookRequest($this->session, 'GET', "/$id/likes");
		$response = $request->execute();
		$graphObject = $response->getGraphObject();
		$data = $graphObject->getProperty('data');
		if(!$data) return false;
		$data = $data->asArray();
		foreach($data as $userLikes) {
			if($userLikes->id == $user) {
				return true;
			}
		}
		return false;
	}

	public function checkComment($id, $user) {
		return true;
	}

	public function checkShare($id, $user) {
		return true;
	}
}
