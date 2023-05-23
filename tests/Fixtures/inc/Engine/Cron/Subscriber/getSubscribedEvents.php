<?php
return [
    'shouldRegister' => [
        'config' => [

        ],
        'expected' => [
	        'cron_schedules'                         => 'add_interval',
	        'init'                                   => 'schedule_cron',
	        "prefixprocess_scheduled_posts" => 'process_scheduled_posts',
	        "prefixprocess_scheduled" => ['process_scheduled', 10, 3],
        ]
    ],

];
