<?php namespace App\Http\Controllers\API;

use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller {

	private $auth;
	private $request;

	public function __construct(Guard $auth, Request $request) {
		$this->middleware('auth');
		$this->auth = $auth;
		$this->request = $request;
	}

	public function index()
	{
		$input = $this->request->only(['provider', 'start', 'end']);
		return Post::whereUserId($this->auth->id())
			->whereProvider($input['provider'])
			//->whereBetween('posted_at', array($input['start'], $input['end']))
			->latest()->get(['id', 'text as title', 'posted_at as start', 'image', 'link', 'provider']);
	}

	public function show($id)
	{
		return Post::with('market')->whereId((int)$id)->first();
	}

	public function store()
	{

	}

	public function destroy($id)
	{

	}
}
