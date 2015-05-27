<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class WebLink extends Model {

	protected $guarded = ['id'];

	public function user()
	{
		return $this->hasOne('App\User');
	}
}
