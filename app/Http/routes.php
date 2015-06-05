<?php

Route::get('/', 'WelcomeController@index');


Route::model('user', 'App\User');

Route::controllers([
	'home' => 'HomeController',
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::resource('user', 'UserController');

Route::group(['prefix' => 'api/v1', 'namespace' => 'API'], function() {
	Route::controllers([
		'trade' => 'TradeController'
	]);
});