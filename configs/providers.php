<?php

defined( 'ABSPATH' ) || exit;

return [
    \CoquardcyrArticleScheduler\Dependencies\LaunchpadFront\ServiceProvider::class,
	\CoquardcyrArticleScheduler\Database\ServiceProvider::class,
	\CoquardcyrArticleScheduler\Dependencies\LaunchpadRenderer\ServiceProvider::class,
	\CoquardcyrArticleScheduler\ServiceProvider::class,
];
