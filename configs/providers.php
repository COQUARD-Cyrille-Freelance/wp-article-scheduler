<?php

defined( 'ABSPATH' ) || exit;

return [
	\CoquardcyrWpArticleScheduler\Database\ServiceProvider::class,
	\CoquardcyrWpArticleScheduler\Dependencies\LaunchpadRenderer\ServiceProvider::class,
	\CoquardcyrWpArticleScheduler\ServiceProvider::class,
];
