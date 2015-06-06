<?php namespace App;

use App\Services\SocialManager;
use Illuminate\Database\Eloquent\Model;

class MarketItem extends Model {

	protected $table = 'market';

	protected $guarded = ['id'];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function post()
	{
		return $this->belongsTo('App\Post');
	}

	public function actionLink() {
		return (new SocialManager(app()))
			->with($this->post->provider)
			->actionLink($this->attributes['action'], $this->post->provider_id);
	}
}
