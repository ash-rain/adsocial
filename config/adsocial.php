<?php return [
	// The starting points given to each user
	'start_points' => 250,

	// List of auth provider identifiers
	'auth_providers' => ['facebook', 'twitter', 'google'],

	// Types of post interactions and their default point rewards
	'trade_actions' => [
		'twitter' => [
			'retweet' => 10,
			'favorite' => 5
		],
		'facebook' => [
			'like' => 5,
			'share' => 10,
			'comment' => 7
		],
		'google' => [
			'plus' => 5,
			'comment' => 10
		]
	],


	// ***** UI *****
	

	// Icon classes for each action
	'action_icons' => [
		'retweet' => 'retweet',
		'favorite' => 'star',
		'like' => 'thumbs-up',
		'comment' => 'comment',
		'share' => 'share',
		'plus' => 'plus',
	],


	// Icon classes for each provider
	'provider_icons' => [
		'twitter' => 'fa fa-twitter',
		'facebook' => 'fa fa-facebook-official',
		'google' => 'fa fa-google-plus'
	]
];