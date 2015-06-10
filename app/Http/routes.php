<?php


Route::model('user', 'App\User');
Route::model('post', 'App\Post');

Route::controller('auth', 'AuthController');

Route::get('me', 'UserController@edit');
Route::post('me', 'UserController@store');
Route::patch('me', 'UserController@update');
Route::get('user/{user}', 'UserController@show');

Route::group(['prefix' => 'api/v1', 'namespace' => 'API'], function() {
	Route::controllers([
		'trade' => 'TradeController'
	]);
});

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@getIndex']);
Route::controller('/', 'HomeController');