<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketItem extends Model {

	protected $table = 'market';

	protected $guarded = ['id'];

	public function user()
	{
		return $this->hasOne('App\User');
	}
}
