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
	]
];