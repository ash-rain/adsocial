<?php namespace App\Http\Controllers;

use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Requests;
use App\User;

class UserController extends Controller {

	public function __construct(Guard $auth)
	{
		$this->middleware('auth', ['except' => ['store']]);
		$this->auth = $auth;
	}
	
	public function show(User $user) {
		return view('profile', compact('user'));
	}

	public function edit() {
		return view('profile_edit');
	}

	public function store(Request $request)
	{
		$user = (new User)->fill($request->only('name'));
		$user->save();
		if($user->id) {
			$this->auth->login($user);
			return redirect()->action('UserController@edit');
		}
		return redirect()->back();
	}

	public function update(Request $request)
	{
		$input = $request->only(['name', 'email']);
		$user = $this->auth->user()->fill($input);
		try {
			$user->save();
		}
		catch(QueryException $e){}
		return redirect()->action('UserController@edit');
	}
}
