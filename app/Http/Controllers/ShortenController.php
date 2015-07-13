<?php namespace App\Http\Controllers;

use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use Exception;
use App\User;
use App\Log;
use App\ShortLink;

class ShortenController extends Controller {

	public function __construct(Guard $auth)
	{
		$this->middleware('auth', ['except' => ['handleShortcode']]);
		$this->middleware('checkUser');
		$this->auth = $auth;
	}

	public function getIndex()
	{
		$shortlinks = ShortLink::whereUserId($this->auth->id())->get();
		return view('shortener', compact('shortlinks'));
	}

	public function postIndex(Request $request)
	{
		$url = $request->input('url');
		if(!$url) {
			throw new Exception('No URL provided');

		}
		$user_id = $this->auth->id();
		$shortlink = new ShortLink(compact('url', 'user_id'));
		$shortlink->save();
		return $shortlink;
	}

	public function handleShortcode($hash)
	{
		$shortLink = ShortLink::whereHash($hash)->first();

		if(isset($shortLink->url))
		{
			$shortLink->increment('visits');
			return redirect($shortLink->url);
		}

		return redirect()->back('/');
	}
}
