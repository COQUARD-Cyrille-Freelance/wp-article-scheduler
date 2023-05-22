<?php

return [
    'sameStatusShouldBailOut' => [
        'config' => [
			  'same_status' => false,
			  'post_id' => 10,
              'new_post' => new WP_Post(['post_status' => 'publish']),
              'old_post' => new WP_Post(['post_status' => 'publish']),
        ],
	    'expected' => [
		    'post_id' => 10,
	    ]
    ],
	'differentStatusShouldDelete' => [
		'config' => [
			'same_status' => true,
			'post_id' => 10,
			'new_post' => new WP_Post(['post_status' => 'publish']),
			'old_post' => new WP_Post(['post_status' => 'draft']),
		],
		'expected' => [
			'post_id' => 10,
		]
	]

];
