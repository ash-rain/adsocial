<?php namespace App\Http\Controllers\Auth;

use Socialize;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\OAuthData;
use App\User;

class AuthController extends Controller {

	use AuthenticatesAndRegistersUsers;

	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => ['getLogout', 'getSocial', 'getCallback']]);
	}

	public function getSocial($provider = 'facebook') {
		return Socialize::with($provider)->redirect();
	}

	public function getCallback($provider = 'facebook')
	{
		$user = Socialize::with($provider)->user();

		// Get or create the user data record
		$provider_id = $user->id;
		$record = OAuthData::firstOrCreate(compact('provider', 'provider_id'));
		$record->token = $user->token;
		$record->user_data = json_encode($user);

		$user = null;

		// Check if this provider is new
		if(!$record->user_id) {
			if($this->auth->check()) {
				// Associate authenticated user with this account
				$record->user_id = $this->auth->id();
			}
			else {
				// Create new user, assign
				$user = new User([
					'name' => $user->name,
					'email' => $user->email,
					]);
				$user->save();
				$record->user_id = $user->id;
			}
		}
		else {
			$user = User::find($record->user_id);
		}
		
		if(!$this->auth->check()) {
			$this->auth->login($user);
		}

		$record->save();

		return redirect('/');
	}
}
