<?php namespace App\Http\Controllers;

use Auth;
use App\Services\SocialManager;
use Illuminate\Support\Collection;
use App\MarketItem;
use App\Post;

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

	public function getAction($post = null, $action = null)
	{
		$post = Post::find($post);
		if(!$post) {	
			return view('action_complete');
		}
		$url = !$action ? false
			: $this->social->with($post->provider)->action($action, $post->provider_id);
		if($url === true) {
			return view('action_complete');
		}
		if(!$url || !parse_url($url)) {
			$url = $post->link;
		}
		return redirect($url);
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
