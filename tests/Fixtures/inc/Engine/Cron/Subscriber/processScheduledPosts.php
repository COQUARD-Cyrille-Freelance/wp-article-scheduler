<?php

use CoquardcyrArticleScheduler\Database\Rows\ArticleSchedules;

return [
    'shouldAddToQueue' => [
        'config' => [
			'rows' => [
				new ArticleSchedules((object) [
					'id' => 12,
					'status' => 'draft',
					'change_date' => 1234658,
				]),
				new ArticleSchedules((object) [
					'id' => 18,
					'status' => 'protected',
					'change_date' => 123454658,
				]),
			]
        ],
    ],

];
