<?php

return [

	'facebook' => [
		'client_id' => env('AUTH_FB_ID'),
		'client_secret' => env('AUTH_FB_SECRET'),
		'redirect' => env('BASE_URL') . 'auth/callback/facebook',
		'scopes' => ['user_posts']
	],

	'twitter' => [
		'client_id' => env('AUTH_TW_ID'),
		'client_secret' => env('AUTH_TW_SECRET'),
		'redirect' => env('BASE_URL') . 'auth/callback/twitter'
	],

	'google' => [
		'client_id' => env('AUTH_GG_ID'),
		'client_secret' => env('AUTH_GG_SECRET'),
		'redirect' => env('BASE_URL') . 'auth/callback/google'
	]
];
