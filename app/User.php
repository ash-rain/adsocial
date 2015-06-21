<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use App\Log;
use Cache;
use DB;

class User extends Model implements AuthenticatableContract {

	use Authenticatable;

	protected $fillable = ['name', 'email', 'password'];

	protected $hidden = ['password', 'remember_token'];

	// Model boot
	public static function boot()
	{
		parent::boot();

		// When creating a new user
		User::created(function($user) {
			(new Log([
				'user_id' => $user->id,
				'reason' => 'register',
				'reward' => config('br.start_points'),
				'flag' => true
				]))->save();
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
	
	public function getReducedAttribute() {
		return DB::table('log')
			->join('market', 'log.market_item_id', '=', 'market.id')
			->join('posts', 'market.post_id', '=', 'posts.id')
			->where('posts.user_id', $this->attributes['id']);
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
		$id = $this->attributes['id'];
		//return Cache::remember("user_{$id}_points", 5, function() use($id)
		//{
			$marketActions = Log::with('market')
				->whereFlag(true)
				->where('user_id', $id)
				->get()->sum('market.reward');
			$otherActions = Log::where('user_id', $id)
				->whereFlag(true)
				->whereNull('market_item_id')
				->get()->sum('reward');
			$reduced = $this->reduced->select('market.reward')->sum('market.reward');
			return $marketActions + $otherActions - $reduced;
		//});
	}
}
