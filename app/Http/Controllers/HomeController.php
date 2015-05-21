<?php namespace App\Http\Controllers;

use App\Services\SocialManager;

class HomeController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getIndex()
	{
		return view('home');
	}

	public function getFeed($provider)
	{
		$socman = new SocialManager(app());
		$feed = $socman->with($provider)->getFeed();
		return view('feed', compact('feed', 'provider'));
	}

}
