<?php

use CoquardcyrWpArticleScheduler\Dependencies\LaunchpadRenderer\Cache\WPFilesystemCache;

defined( 'ABSPATH' ) || exit;

$plugin_name = 'coquardcyr wp article scheduler';

$plugin_launcher_path = dirname( __DIR__ ) . '/';

return [
	'plugin_name'                  => $plugin_name,
	'plugin_slug'                  => sanitize_key( $plugin_name ),
	'plugin_version'               => '1.0.0',
	'plugin_launcher_file'         => $plugin_launcher_path . '/' . basename( $plugin_launcher_path ) . '.php',
	'plugin_launcher_path'         => $plugin_launcher_path,
	'plugin_inc_path'              => realpath( $plugin_launcher_path . 'inc/' ) . '/',
	'prefix'                       => 'coquardcyr_wp_article_scheduler_',
	'translation_key'              => 'coquardcyrwparticlescheduler',
	'is_mu_plugin'                 => false,
	'action_scheduler_queue_group' => 'coquardcyr_wp_article_scheduler',
	'template_path'                => $plugin_launcher_path . '/files/templates/',
	'root_directory'               => WP_CONTENT_DIR . '/cache/',
	'renderer_cache_enabled'       => true,
	'renderer_caching_solution'    => [ WPFilesystemCache::class ],
];
