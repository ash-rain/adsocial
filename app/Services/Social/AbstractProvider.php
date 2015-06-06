<?php namespace App\Services\Social;

use Auth;
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
			$target[$key] = $value
				? (is_callable($value)
					? $value($source)
					: $source[$value])
				: null;
		}

		if(!(int)$target['posted_at']) {
			$target['posted_at'] = strtotime($target['posted_at']);
		}
		
		$target['provider'] = $this->provider;
		$target['provider_id'] = $id;
		$target['user_id'] = Auth::id();
		
		$post = new Post($target);
		$post->save();
		return $post;
	}

	public function feed($limit = self::LIMIT)
	{
		$feed = $this->getFeed($limit);
		$feed = array_map(function($f){ return $this->post($f->{$this->idField}); }, $feed);
		return $feed;
	}
}