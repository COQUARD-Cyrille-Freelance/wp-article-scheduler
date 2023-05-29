<?php

defined( 'ABSPATH' ) || exit;

return [
    \CoquardcyrWpArticleScheduler\Dependencies\LaunchpadFront\ServiceProvider::class,
	\CoquardcyrWpArticleScheduler\Database\ServiceProvider::class,
	\CoquardcyrWpArticleScheduler\Dependencies\LaunchpadRenderer\ServiceProvider::class,
	\CoquardcyrWpArticleScheduler\ServiceProvider::class,
];
