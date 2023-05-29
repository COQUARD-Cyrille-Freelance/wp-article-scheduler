<?php
/**
 * Plugin Name: WP article scheduler
 * Description: Schedule your article to unpublished.
 * Version: 1.0.0
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: coquardcyrwparticlescheduler
 * Requires at least: 6.2
 * Requires PHP: 7.2
 * Domain Path: /languages
 */
use function CoquardcyrWpArticleScheduler\Dependencies\LaunchpadCore\boot;

defined( 'ABSPATH' ) || exit;


require __DIR__ . '/inc/Dependencies/LaunchpadCore/boot.php';

boot(__FILE__);
require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc/Dependencies' . DIRECTORY_SEPARATOR . 'ActionScheduler' . DIRECTORY_SEPARATOR . 'action-scheduler.php';
