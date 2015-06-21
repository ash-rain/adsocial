<?php

Route::model('user', 'App\User');
Route::model('post', 'App\Post');

Route::controller('auth', 'AuthController');
Route::controller('checkout', 'CheckoutController');

Route::get('me', 'UserController@edit');
Route::post('me', 'UserController@store');
Route::patch('me', 'UserController@update');
Route::get('user/{user}', 'UserController@show');

Route::group(['prefix' => 'api/v1', 'namespace' => 'API'], function() {
	Route::controllers([
		'trade' => 'TradeController',
		'post' => 'PostController'
	]);
});

Route::get('/', ['as' => 'home', 'uses' => 'SiteController@getIndex']);
Route::controller('/', 'SiteController');