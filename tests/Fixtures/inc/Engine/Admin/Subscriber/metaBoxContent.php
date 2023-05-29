<?php

use CoquardcyrWpArticleScheduler\Database\Rows\ArticleSchedules;

return [
    'shouldRenderWithParameters' => [
        'config' => [
              'post' => new WP_Post([
				  'ID' => 10,
				  'post_status' => 'publish'
              ]),
	         'statuses' => [
				 'draft' => 'Draft',
		         'protected' => 'Protected',
		         'private'   => 'Private',
		         'publish'   => 'Publish'
	         ],
	        'scheduled' => new ArticleSchedules((object) [
				'post_id' => 10,
				'status' => 'draft',
				'change_date' => 1230120,
	        ]),
	        'should_render' => true,
	        'full_key' => 'full_key',
        ],
	    'expected' => [
			'key' => 'app',
			'full_key' => 'full_key',
			'full_key_data' => 'full_key_data',
		    'js_data' => [
				    'statuses' => [
					    [
						    'key' => '',
						    'name' => 'Unselected',
					    ],
					    [
						    'key' => 'draft',
						    'name' => 'Draft',
					    ],
					    [
						    'key' => 'protected',
						    'name' => 'Protected',
					    ],
					    [
						    'key' => 'private',
						    'name' => 'Private',
					    ]
				    ],
				    'prefix' => 'prefix',
				    'initial' => [
					    'date' => '',
					    'status' => '',
				    ],
		    ],
			'template' => 'meta-box',
		    'post_id' => 10,
		    'parameters' => [
				'keys' => [
					'post_id' => 10,
					'current_status' => '',
					'date' => "",
					'min_date' => 'date',
				],
			    'parameters' => [
				    'post_id' => 10,
				    'current_status' => '',
				    'date' => "",
				    'min_date' => 'date',
					'statuses' => [
						'draft' => 'Draft',
						'protected' => 'Protected',
						'private'   => 'Private'
					],
				    'prefix' => 'prefix'
			    ]
		    ]
	    ]
    ],
	'notPublishShouldBailOut' => [
		'config' => [
			'post' => new WP_Post([
				'ID' => 10,
				'post_status' => 'draft'
			]),
			'statuses' => [
				'draft' => 'Draft',
				'protected' => 'Protected',
				'private'   => 'Private'
			],
			'scheduled' => new ArticleSchedules((object) [
				'post_id' => 10,
				'status' => 'draft',
				'change_date' => '1230120',
			]),
			'should_render' => false,
			'full_key' => 'full_key',
		],
		'expected' => [
			'key' => 'app',
			'full_key' => 'full_key',
			'full_key_data' => 'full_key_data',
			'js_data' => [
				'statuses' => [
					[
						'key' => '',
						'name' => 'Unselected',
					],
					[
						'key' => 'draft',
						'name' => 'Draft',
					],
					[
						'key' => 'protected',
						'name' => 'Protected',
					],
					[
						'key' => 'private',
						'name' => 'Private',
					]
				],
				'prefix' => 'prefix',
				'initial' => [
					'date' => '',
					'status' => '',
				],
			],
			'template' => 'meta-box',
			'parameters' => [
				'post_id' => 10,
				'current_status' => 'draft',
				'date' => "1970-01-15",
				'min_date' => date( 'Y-m-d', time() ),
				'statuses' => [
					'draft' => 'Draft',
					'protected' => 'Protected',
					'private'   => 'Private'
				],
				'prefix' => 'prefix'
			]
		]
	],
];
