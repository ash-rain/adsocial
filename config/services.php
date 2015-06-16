<?php

return [

	'paypal' => [
		'client_id' => 'AUps4uSIQi66LNEV6A7zn62MvxT3lu2iqhyw8CC-Jn0s7HPCrbMzFjaM2_X6hWkXPLSCG2mRsIxDbWBd',
		'secret' => 'EJTmTwAJC8AEXh0kPOWywtuhkJGJF6kmv3UAOqPBMJ2khfUTEJNCh42DrRjqF1i_syDRxITsXviCKsDf'
	],

	'facebook' => [
		'client_id' => env('AUTH_FB_ID'),
		'client_secret' => env('AUTH_FB_SECRET'),
		'redirect' => env('BASE_URL') . 'auth/callback/facebook',
		'scopes' => ['user_posts', 'publish_actions', 'publish_pages']
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
	],

	'linkedin' => [
		'client_id' => env('AUTH_LI_ID'),
		'client_secret' => env('AUTH_LI_SECRET'),
		'redirect' => env('BASE_URL') . 'auth/callback/linkedin'
	]
];
