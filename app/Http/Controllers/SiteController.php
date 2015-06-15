<?php namespace App\Http\Controllers;

use Auth;
use Queue;
use App\Services\SocialManager;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\MarketItem;
use App\Post;
use App\Log;

class SiteController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('checkUser');
		$this->social = new SocialManager(app());
	}

	public function getIndex()
	{
		$market = array();
		$providers = Auth::user()->providers;
		$query = MarketItem::where(function($q) use ($providers) {
			foreach ($providers as $provider) {
				$q->orWhere('provider', $provider);
			}
		});
		foreach ($query->get()->groupBy('post_id') as $key => $marketItem) {
			$market[$key] = (new Collection($marketItem))->keyBy('action');
		}
		return view('home', compact('market'));
	}

	public function getAction($post = null, $action = null)
	{
		$post = Post::find($post);
		
		if($action) {
			// Log action and push to queue
			$log = Log::firstOrCreate([
				'reason' => $action,
				'market_item_id' => $post->market()->whereAction($action)->first()->id
			]);
			
			//if($log->id) {
			//	return view('action_complete');
			//}
			Auth::user()->log()->save($log);
			$q = Queue::later(Carbon::now()->addSeconds(15), 'App\Jobs\AwaitAction', ['log' => $log->id]);
			dd($q);
		}

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
