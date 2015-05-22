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
		$input = $request->only('provider', 'provider_id', 'action', 'reward');
		
		if(count($array) != count(array_filter($array, 'strlen'))) {
			throw new \Exception('Missing input');
		}

		$input['user_id'] = Auth::id();

		return MarketItem::firstOrCreate($input);
	}

}