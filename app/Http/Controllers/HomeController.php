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
		dd($socman->with($provider)->getFeed());
	}

}
