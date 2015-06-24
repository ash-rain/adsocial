<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model {

	protected $guarded = ['id'];

	protected $dates = ['posted_at'];

	public function market() {
		return $this->hasMany('App\MarketItem');
	}

	public function log() {
		return $this->hasManyThrough('App\Log', 'App\MarketItem');
	}

    public function categories() {
    	return $this->belongsToMany('App\Category');
    }
}
