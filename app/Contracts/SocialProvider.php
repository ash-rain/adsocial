<?php namespace App\Contracts;

interface SocialProvider {
	
	public function getFeed();
	
	public function getPost($id);
}