<?php namespace App\Http\Controllers\API;

use App\Post;

class PostController extends Controller {

	public function __construct() {
		$this->middleware('auth');
	}

	public function getDetails($id)
	{
		return Post::with('market')->whereId((int)$id)->first();
	}
}