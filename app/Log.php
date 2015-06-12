<?php namespace App;

use App\Services\SocialManager;
use Illuminate\Database\Eloquent\Model;

class Log extends Model {

	protected $table = 'log';

	protected $guarded = ['id'];

	protected $dates = ['created_at'];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function marketItem()
	{
		return $this->belongsTo('App\MarketItem');
	}
}