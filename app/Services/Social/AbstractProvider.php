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
		
		$target['provider'] = $this->provider;
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
		return Auth::user()->oauth_data()->whereProvider($this->provider)->first();
	}

	public function action($action, $id)
	{
		$method = 'action' . ucfirst($action);
		if(method_exists($this, $method)) {
			$this->$method($id);
		}
		else {
			throw new Exception('Undefined method '. $method);
			
		}
	}
}