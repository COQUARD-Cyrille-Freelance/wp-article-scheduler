<?php
return [
    'shouldAddInterval' => [
        'config' => [
              'schedules' => [],
	        'interval' => MINUTE_IN_SECONDS,
        ],
        'expected' => [
			'prefixprocess_scheduled_posts' => [
				'interval' => MINUTE_IN_SECONDS,
				'display' => 'plugin_name process scheduled posts'
			]
        ]
    ],

];
