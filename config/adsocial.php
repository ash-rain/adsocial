<?php return [
	// The starting points given to each user
	'start_points' => 250,

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
		]
	],
	
	// Icon classes for each action
	'action_icons' => [
		'retweet' => 'retweet',
		'favorite' => 'star',
	]
];