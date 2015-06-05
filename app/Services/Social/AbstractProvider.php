<?php namespace App\Services\Social;

use App\Contracts\SocialProvider;

abstract class AbstractProvider implements SocialProvider {
	
	public function getFeed()
	{
	}


	public function getPost($id)
	{
	}
}