<?php namespace App\Services\Social;

use Auth;
use Exception;
use Cache;
use Closure;
use App\Contracts\SocialProvider;
use App\Post;

abstract class AbstractProvider implements SocialProvider {

	const LIMIT = 20;
	protected $idField = 'id';
	protected $fieldMap = [];
	protected $user;
	protected $provides;
	protected $useCache = false;

	public function __construct() {
		$this->user = Auth::user();
	}

	public function post($id)
	{
		$post = Post::whereProviderId($id)->first();
		if($post) return $post;

		$source = (array)$this->getPost($id);
		$postData = array();

		foreach ($this->fieldMap as $key => $value)
		{
			$t = null;
			if($value)
			{
				// closure
				if(is_object($value) && ($value instanceof Closure)) {
					$t = $value($source);
				}
				// string key
				else if(is_string($value) && isset($source[$value])) {
					$t = $source[$value];
				}
				// array of fallback string keys
				else if(is_array($value)) {
					foreach ($value as $v) {
						if(isset($source[$v]) && strlen($source[$v])) {
							$t = $source[$v];
							break;
						}
					}
				}
			}
			$postData[$key] = $t;
		}

		if($postData['posted_at'] && (string)(int)$postData['posted_at'] != $postData['posted_at']) {
			$postData['posted_at'] = strtotime($postData['posted_at']);
		}

		$postData['provider'] = $this->provides;
		$postData['provider_id'] = $id;
		$postData['user_id'] = $this->user->id;
		$postData['meta'] = json_encode($source);

		$post = new Post($postData);
		$post->save();
		return $post;
	}

	public function feed($limit = static::LIMIT)
	{
		$feed = 0;
		try {
			$feed = $this->getFeed($limit);
			$feed = array_map(function($f) {
				$providerId = $f->{$this->idField};
				if($this->useCache)
				{
					return Cache::remember("{$this->provides}_post_$providerId", 10, function() {
						return $this->post($providerId);
					});
				}

				return $this->post($providerId);
			}, $feed);
		}
		catch(\Exception $e) {
			// TODO: logging
			$feed = Post::whereUserId(Auth::id())->whereProvider($this->provides)
				->limit($limit)->get();
		}
		return collect($feed);
	}

	public function providerData()
	{
		if(!$this->user) return;
		return $this->user->oauth_data()->whereProvider($this->provides)->first();
	}

	public function action($action, $id)
	{
		$method = 'action' . ucfirst($action);
		if(method_exists($this, $method)) {
			return $this->$method($id);
		}
		else if(isset($this->actionMap) && isset($this->actionMap[$action])) {
			return sprintf($this->actionMap[$action], $id);
		}
		return false;
	}

	public function check($market, $user)
	{
		$method = 'check' . ucfirst($market->action);
		if (method_exists($this, $method)) {
			$this->user = $market->user;
			if (!config("br.actions.{$this->provides}.sourceOnly")) {
				$oauth_data = $user->oauth_data()->whereProvider($this->provides)->first();
				$provider_id = $oauth_data->provider_id;
			} else {
				$provider_id = $user->id;
			}
			return $this->$method($market->post->provider_id, $provider_id);
		} else {
			dd(
				$user->log()
					->wherePostId($market->post_id)
					->whereReason($market->action)
					->latest()->first()
			);
		}
		return false;
	}
}
