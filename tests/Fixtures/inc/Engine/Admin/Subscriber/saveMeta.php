<?php

use CoquardcyrArticleScheduler\Database\Rows\ArticleSchedules;

$row = new ArticleSchedules((object) [
	'post_id'     => 42,
	'status'      => 'status',
	'change_date' => 'date',
]);

return [
    'shouldAdd' => [
	    'config' => [
		    'post' => [
			    "meta_prefixfields_meta_box_nonce" => 'test',
			    'prefixstatus' => 'status',
			    'prefixchange_date' => 'date',
		    ],
		    'post_id' => 42,
		    'row' => $row,
		    'has_value' => true,
		    'nonce' => true,
		    'can' => true,
	    ],
	    'expected' => [
		    'post_value' => 'test',
		    'action' => 'meta_prefix_fields_save_meta_box_data',
		    'capacity' => 'edit_post',
		    'post_id' => 42,
		    'row_data' => [
			    'post_id'     => 42,
			    'status'      => 'status',
			    'change_date' => 'date',
		    ],
		    'row' => $row,
	    ]
    ],
    'noValueShouldBailOut' => [
	    'config' => [
			'post' => [

			],
		    'post_id' => 42,
			'row' => $row,
			'has_value' => false,
			'nonce' => true,
			'can' => true,
	    ],
	    'expected' => [
			'post_value' => 'test',
			'action' => 'meta_prefix_fields_save_meta_box_data',
			'capacity' => 'edit_post',
			'post_id' => 42,
			'row_data' => [
				'post_id'     => 42,
				'status'      => 'status',
				'change_date' => 'date',
			],
			'row' => $row,
	    ]
    ],
    'invalidNonceShouldBailOut' => [
	    'config' => [
		    'post' => [
			    "meta_prefixfields_meta_box_nonce" => 'test',
			    'prefixstatus' => 'status',
			    'prefixchange_date' => 'date',
		    ],
		    'post_id' => 42,
		    'row' => $row,
		    'has_value' => true,
		    'nonce' => false,
		    'can' => true,
	    ],
	    'expected' => [
		    'post_value' => 'test',
		    'action' => 'meta_prefix_fields_save_meta_box_data',
		    'capacity' => 'edit_post',
		    'post_id' => 42,
		    'row_data' => [
			    'post_id'     => 42,
			    'status'      => 'status',
			    'change_date' => 'date',
		    ],
		    'row' => $row,
	    ]
    ],
    'invalidRightShouldBailOut' => [
	    'config' => [
		    'post' => [
			    "meta_prefixfields_meta_box_nonce" => 'test',
			    'prefixstatus' => 'status',
			    'prefixchange_date' => 'date',
		    ],
			'post_id' => 42,
		    'row' => $row,
		    'has_value' => true,
		    'nonce' => true,
		    'can' => false,
	    ],
	    'expected' => [
		    'post_value' => 'test',
		    'action' => 'meta_prefix_fields_save_meta_box_data',
		    'capacity' => 'edit_post',
		    'post_id' => 42,
		    'row_data' => [
			    'post_id'     => 42,
			    'status'      => 'status',
			    'change_date' => 'date',
		    ],
		    'row' => $row,
	    ]
    ],

];
