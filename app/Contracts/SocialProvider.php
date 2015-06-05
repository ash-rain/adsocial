<?php namespace App\Contracts;

interface SocialProvider {
	
	// Get the raw feed
	public function getFeed();
	
	// Return App\Post model
	public function getPost($id);
}