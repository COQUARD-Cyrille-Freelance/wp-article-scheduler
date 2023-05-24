<?php
return [
    'shouldProcess' => [
        'config' => [
              'post_id' => 42,
              'status' => 'draft',
	          'date_superior' => false,
	          'invalid_post' => false,
              'change_date' => strtotime('yesterday'),
	          'post' => new WP_Post(['ID' => 42, 'post_status' => 'publish'])
        ],
	    'expected' => [
			'post_id' => 42,
			'post' => new WP_Post(['ID' => 42, 'post_status' => 'draft'])
	    ]
    ],
    'InTheFutureShouldNotProcess' => [
	    'config' => [
		    'post_id' => 42,
		    'status' => 'draft',
		    'date_superior' => true,
		    'invalid_post' => false,
		    'change_date' => strtotime('tomorrow'),
		    'post' => new WP_Post(['ID' => 42, 'post_status' => 'publish'])
	    ],
	    'expected' => [
		    'post_id' => 42,
		    'post' => new WP_Post(['ID' => 42, 'post_status' => 'draft'])
	    ]
    ],
    'InvalidPostShouldNotProcess' => [
	    'config' => [
		    'post_id' => 42,
		    'status' => 'draft',
		    'date_superior' => false,
		    'invalid_post' => true,
		    'change_date' => strtotime('yesterday'),
		    'post' => null
	    ],
	    'expected' => [
		    'post_id' => 42,
		    'post' => new WP_Post(['ID' => 42, 'post_status' => 'draft'])
	    ]
    ],
];
