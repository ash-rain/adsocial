<?php namespace App\Services\Social;

use Auth;
use Twitter;
use App\Contracts\SocialProvider;

class TwitterProvider extends AbstractProvider implements SocialProvider {

	protected $provides = 'twitter';
	protected $fieldMap = array(
		'text' => 'text',
		'posted_at' => 'created_at'
	);
	protected $actionMap = array(
		'retweet' => 'https://twitter.com/intent/retweet?tweet_id=%d',
		'favorite' => 'https://twitter.com/intent/favorite?tweet_id=%d',
	);

	public function getFeed($limit = parent::LIMIT)
	{
		$providerData = Auth::user()->oauth_data()->whereProvider('twitter')->first();
		return Twitter::getUserTimeline([
			'screen_name' => $providerData->user_data->nickname,
			'count' => $limit,
			'format' => 'object'
			]);
	}

	public function getPost($id)
	{
		return Twitter::get('statuses/show', compact('id'));
	}
}