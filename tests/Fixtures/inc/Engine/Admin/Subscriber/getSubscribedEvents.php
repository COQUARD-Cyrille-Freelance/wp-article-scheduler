<?php
return [
    'shouldReturnEvents' => [
        'config' => [

        ],
        'expected' => [
	        'admin_init' => 'add_meta_box',
	        'save_post' => 'save_meta',
	        'post_updated' => ['maybe_delete_schedule', 10, 3],
        ]
    ],

];
