<?php namespace App\Http\Controllers;

use Auth;
use App\Services\SocialManager;
use App\MarketItem;

class HomeController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getIndex()
	{
		$market = MarketItem::get()->groupBy('provider_id');
		return view('home', compact('market'));
	}

	public function getFeed($provider)
	{
		$socman = new SocialManager(app());
		$feed = $socman->with($provider)->getFeed();
		$providerUser = Auth::user()->oauth_data()
			->whereProvider($provider)
			->first()->user_data;
		$market = MarketItem::whereUserId(Auth::id())->whereProvider($provider)
			->get()->groupBy('provider_id')->toArray();

		return view('feed', compact('feed', 'provider', 'providerUser', 'market'));
	}

}
