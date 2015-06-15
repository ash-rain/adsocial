<?php namespace App\Services\Social;

use Auth;
use Exception;
use Closure;
use App\Contracts\SocialProvider;
use App\Post;

abstract class AbstractProvider implements SocialProvider {

	const LIMIT = 20;
	protected $idField = 'id';
	protected $fieldMap = [];
	protected $user;
	protected $provides;

	public function __construct() {
		$this->user = Auth::user();
	}

	public function post($id)
	{
		$post = Post::whereProviderId($id)->first();
		if($post) return $post;

		$source = (array)$this->getPost($id);
		$target = array();

		foreach ($this->fieldMap as $key => $value) {
			
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
				// fallback array of string keys
				else if(is_array($value)) {
					foreach ($value as $v) {
						if(isset($source[$v]) && strlen($source[$v])) {
							$t = $source[$v];
							break;
						}
					}
				}
			}
			$target[$key] = $t;
		}

		if((string)(int)$target['posted_at'] !== $target['posted_at']) {
			$target['posted_at'] = strtotime($target['posted_at']);
		}
		
		$target['provider'] = $this->provides;
		$target['provider_id'] = $id;
		$target['user_id'] = Auth::id();
		
		$post = new Post($target);
		$post->save();
		return $post;
	}

	public function feed($limit = static::LIMIT)
	{
		$feed = $this->getFeed($limit);
		$feed = array_map(function($f){ return $this->post($f->{$this->idField}); }, $feed);
		return $feed;
	}

	public function providerData() {
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
		if(method_exists($this, $method)) {
			$this->user = $market->user;
			$oauth_data = $user->oauth_data()->whereProvider($this->provides)->first();
			return $this->$method($market->post->provider_id, $oauth_data->provider_id);
		}
		return false;
	}
}