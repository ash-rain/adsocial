<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use App\Log;
use Cache;

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

	public function getPointsAttribute()
	{
		$points = $this->attributes['points'];
		$id = $this->attributes['id'];
		$points += Cache::remember("user_{$id}_points", 5, function() use($id) {
			return Log::with('market')->where('user_id', $id)->get()->sum('market.reward');
		});
		return $points;
	}
}
