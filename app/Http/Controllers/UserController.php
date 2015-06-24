<?php namespace App\Http\Controllers;

use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Requests;
use App\User;
use App\Log;
use Exception;

class UserController extends Controller {

	public function __construct(Guard $auth)
	{
		$this->middleware('auth', ['except' => ['store']]);
		$this->auth = $auth;
	}
	
	public function show(User $user) {
		return view('profile', compact('user'));
	}

	public function edit()
	{
		$reduced = $this->auth->user()->reduced
			->join('users', 'log.user_id', '=', 'users.id')
			->select('log.updated_at', 'log.reason', 'log.user_id', 'users.name', 'market.reward', 'market.provider', 'posts.text')
			->get();

		$earned = $this->auth->user()->earned
			->select('log.updated_at', 'log.reason', 'log.reward', 'market.reward as market_reward', 'market.provider', 'posts.text', 'posts.link')
			->get();

		return view('profile_edit', compact('earned', 'reduced'));
	}

	public function store(Request $request)
	{
		try
		{
			$input = $request->only(['email', 'password']);
			$input['password'] = bcrypt($input['password']);
			$user = (new User)->fill($input);
			$user->save();
			
			if($user->id) {
				$this->auth->login($user);
				return redirect()->action('UserController@edit');
			}
		}
		catch(Exception $e) { }
		return redirect()->back('/');
	}

	public function update(Request $request)
	{
		$input = $request->only(['name', 'email', 'password']);

		if($input['password']) {
			$input['password'] = bcrypt($input['password']);
		}
	
		$this->auth->user()
			->fill($input)
			->save();
		
		return redirect()->action('UserController@edit');
	}
}
