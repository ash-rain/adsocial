<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class OAuthData extends Model {

	protected $table = 'oauth_data';

	protected $guarded = [];

	protected $hidden = ['token', 'user_id'];

	public function user()
	{
		return $this->hasOne('App\User');
	}
}
