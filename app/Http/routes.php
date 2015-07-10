<?php

Route::model('user', 'App\User');
Route::model('post', 'App\Post');

Route::controllers([
	'auth' => 'AuthController',
	'checkout' => 'CheckoutController',
	'schedule' => 'ScheduleController',
	'shorten' => 'ShortenController'
]);

Route::get('me', 'UserController@edit');
Route::post('me', 'UserController@store');
Route::patch('me', 'UserController@update');
Route::get('user/{user}', 'UserController@show');

Route::group(['prefix' => 'api/v1', 'namespace' => 'API'], function() {
	Route::controllers([
		'trade' => 'TradeController'
	]);
	Route::resources([
		'post' => 'PostController'
	]);
	Route::post('post/{post}/reschedule', 'PostController@reschedule');
});

Route::get('/{hash}', 'ShortenController@handleShortcode');

Route::get('/', ['as' => 'home', 'uses' => 'SiteController@getIndex']);
Route::controller('/', 'SiteController');
