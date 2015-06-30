<?php namespace App\Services\Social;

use Auth;
use App\Contracts\SocialProvider;
use App\Contracts\SocialPost;
use App\Post;

class WebLinkProvider extends AbstractProvider implements SocialProvider {

	protected $provides = 'weblink';

	public function __construct()
	{
		parent::__construct();
	}

	public function getFeed()
	{
		return Post::whereProvider('weblink')->get();
	}

	public function publish(SocialPost $post)
	{

	}

	public function getPost($id)
	{
		return Post::find($id);
	}

	public function actionVisit($id)
	{
		$post = Post::find($id);
		return $post->link;
	}
}
