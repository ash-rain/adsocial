<?php namespace App\Http\Controllers;

use Auth;
use App\Services\SocialManager;
use Illuminate\Support\Collection;
use App\MarketItem;

class HomeController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
		$this->social = new SocialManager(app());
	}

	public function getIndex()
	{
		$market = array();
		foreach (MarketItem::get()->groupBy('post_id') as $key => $marketItem) {
			$market[$key] = (new Collection($marketItem))->keyBy('action');
		}
		return view('home', compact('market'));
	}

	public function getAction($provider, $id, $action)
	{
		$status = $this->social->with($provider)->action($action, $id);
		return $status;
	}

	public function getFeed($provider)
	{
		$feed = $this->social->with($provider)->feed();

		$providerUser = Auth::user()->oauth_data()
			->whereProvider($provider)
			->first()->user_data;
		
		return view('feed', compact('feed', 'provider', 'providerUser'));
	}

}
