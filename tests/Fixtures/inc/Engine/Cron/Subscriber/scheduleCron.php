<?php
return [
    'shouldRegister' => [
        'config' => [
			'has_cron' =>  false,
        ],
    ],
    'AlreadyThereshouldNotRegister' => [
	    'config' => [
		    'has_cron' =>  true,
	    ],
    ],
];
