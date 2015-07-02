<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
	protected $fillable = ['url', 'user_id'];

	public static function boot()
	{
	    parent::boot();
			ShortLink::creating(function($model) {
				$model->hash = self::makeHash($model->url);
			});
	}

  public function user() {
		return $this->belongsTo('App\User');
	}

	private static function makeHash($url) {
		$hash = preg_replace('/[^A-Za-z0-9]/', '', bcrypt($url));
		$hash = substr($hash, -16);
		return $hash;
	}
}
