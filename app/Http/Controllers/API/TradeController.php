<?php namespace App\Http\Controllers\API;

use Auth;
use Illuminate\Http\Request;
use App\Services\SocialManager;
use App\MarketItem;

class TradeController extends Controller {

	public function __construct() {
		$this->middleware('auth');
	}

	public function postBoost(Request $request)
	{
		$input = $request->only('provider', 'provider_id');

		foreach (config('adsocial.trade_actions.' . $input['provider']) as $key => $value)
		{
			$input['user_id'] = Auth::id();
			$input['action'] = $key;
			$reward = (int)$request->input($key);

			if($reward) {
				$item = MarketItem::firstOrCreate($input);
				$item->reward = $reward;
				$item->save();
			}
			else {
				$item = MarketItem::whereProvider($input['provider'])
					->whereProviderId($input['provider_id'])
					->whereAction($input['action'])
					->first();
				if($item) {
					$item->delete();
				}
			}
		}
	}

}