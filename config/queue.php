<?php

return [

	'default' => env('QUEUE_DRIVER', 'sync'),

	'connections' => [

		'sync' => [
			'driver' => 'sync',
		],

		'database' => [
			'driver' => 'database',
			'table' => 'jobs',
			'queue' => 'default',
			'expire' => 60,
		],

	],

	'failed' => [
		'database' => 'mysql', 'table' => 'failed_jobs',
	],

];
