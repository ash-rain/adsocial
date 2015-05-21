<?php namespace App\Http\Controllers;

use Auth;
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
		$providerUser = Auth::user()->oauth_data()->whereProvider($provider)->first()->user_data;
		return view('feed', compact('feed', 'provider', 'providerUser'));
	}

}
