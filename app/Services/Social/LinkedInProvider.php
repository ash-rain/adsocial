<?php namespace App\Services\Social;

use Auth;
use Happyr\LinkedIn;
use App\Contracts\SocialProvider;

class LinkedInProvider extends AbstractProvider implements SocialProvider {

	protected $provides = 'linkedin';
	protected $fieldMap = array(
		'text' => 'text',
		'posted_at' => 'created_at'
	);

	public function __construct()
	{
		parent::__construct();
		$this->linkedin = new LinkedIn();
	}

	public function getFeed($limit = parent::LIMIT)
	{
		return Twitter::getUserTimeline([
			'screen_name' => $this->providerData()->user_data->nickname,
			'count' => $limit,
			'format' => 'object'
			]);
	}

	public function getPost($id)
	{
		return Twitter::get('statuses/show', compact('id'));
	}

}