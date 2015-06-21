<?php namespace App\Http\Controllers\API;

use Auth;
use Illuminate\Http\Request;
use App\Services\SocialManager;
use App\MarketItem;
use App\Post;

class TradeController extends Controller {

	public function __construct() {
		$this->middleware('auth');
	}

	public function postBoost(Request $request)
	{
		$post = Post::find((int)$request->input('post_id'));

		if(!$post) {
			throw new \Exception('Post not found');
		}

		foreach(config('br.actions.'. $post->provider) as $key => $value)
		{
			$input['provider'] = $post->provider;
			$input['user_id'] = Auth::id();
			$input['post_id'] = $post->id;
			$input['action'] = $key;
			$reward = (int)$request->input($key);
			if($reward) {
				$item = MarketItem::firstOrCreate($input);
				$item->reward = $reward;
				$item->save();
			}
			else {
				$item = MarketItem::whereProvider($input['provider'])
					->wherePostId($input['post_id'])
					->whereAction($input['action'])
					->first();
				if($item) {
					$item->delete();
				}
			}
		}
	}

}