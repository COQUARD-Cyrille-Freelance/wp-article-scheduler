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
        ],
	    'expected' => [
			'template' => 'meta-box',
		    'post_id' => 10,
		    'parameters' => [
				'keys' => [
					'post_id' => 10,
					'current_status' => '',
					'date' => "",
					'min_date' => date( 'Y-m-d', time() ),
				],
			    'parameters' => [
				    'post_id' => 10,
				    'current_status' => '',
				    'date' => "",
				    'min_date' => date( 'Y-m-d', time() ),
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
		],
		'expected' => [
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
