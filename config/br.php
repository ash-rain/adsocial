<?php return [
	// The starting points given to each user
	'start_points' => 250,

	// Providers and types of post interaction
	'actions' => [
		'twitter' => [
			'icon' => 'fa fa-twitter',
			'retweet' => [
				'default' => 10,
				'icon' => 'retweet',
			],
			'favorite' => [
				'default' => 5,
				'icon' => 'star',
			]
		],
		'facebook' => [
			'icon' => 'fa fa-facebook-official',
			'like' => [
				'default' => 5,
				'icon' => 'thumbs-up',
			],
			'share' => [
				'default' => 10,
				'icon' => 'share',
			],
			'comment' => [
				'default' => 7,
				'icon' => 'comment',
			]
		],
		'google' => [
			'icon' => 'fa fa-google-plus',
			'plus' => [
				'default' => 5,
				'icon' => 'plus',
			],
			'comment' => [
				'default' => 10,
				'icon' => 'comment',
			]
		],
		'linkedin' => [
			'icon' => 'fa fa-linkedin',
			'authOnly' => true
		]
	],

	// Payment plans
	'plans' => [
		'one' => [
			'cost' => 4.99,
			'points' => 1000,
			'promoDays' => 0
		],
		'two' => [
			'cost' => 12.99,
			'points' => 4000,
			'promoDays' => 1
		],
		'three' => [
			'cost' => 49.99,
			'points' => 11000,
			'promoDays' => 4
		],
		'four' => [
			'cost' => 99.99,
			'points' => 24000,
			'promoDays' => 10
		]
	],

	'checkout' => [
		'currency' => 'USD',
		'currency_code' => 'USD',
	]
];