<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract {

	use Authenticatable;

	protected $fillable = ['name', 'email', 'password'];

	protected $hidden = ['password', 'remember_token'];

	// Model boot
	public static function boot()
	{
		parent::boot();

		// When creating a new user
		User::creating(function($user) {
			$user->points = config('adsocial.start_points');
		});
	}

	public function oauth_data() {
		return $this->hasMany('App\OAuthData');
	}

	public function posts() {
		return $this->hasMany('App\Post');
	}

	public function log() {
		return $this->hasMany('App\Log');
	}

	public function getProvidersAttribute()
	{
		$list = array();
		foreach ($this->oauth_data as $od) {
			$list[] = $od->provider;
		}
		return $list;
	}
}
