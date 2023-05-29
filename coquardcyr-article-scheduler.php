<?php
/**
 * Plugin Name: Article scheduler
 * Description: Schedule your article to unpublished.
 * Version: 1.0.0
 * Author: COQUARD Cyrille
 * Author URI: https://mitango.app
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: coquardcyrarticlescheduler
 * Requires at least: 6.2
 * Requires PHP: 7.2
 * Domain Path: /languages
 */
use function CoquardcyrArticleScheduler\Dependencies\LaunchpadCore\boot;

defined( 'ABSPATH' ) || exit;


require __DIR__ . '/inc/Dependencies/LaunchpadCore/boot.php';

boot(__FILE__);
require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc/Dependencies' . DIRECTORY_SEPARATOR . 'ActionScheduler' . DIRECTORY_SEPARATOR . 'action-scheduler.php';
